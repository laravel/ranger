<?php

namespace Laravel\Ranger\Resolvers\Concerns;

use Illuminate\Support\Arr;
use Laravel\Ranger\Known\Known;
use Laravel\Ranger\Types\ClassType;
use Laravel\Ranger\Types\Contracts\Type as TypeContracd;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;
use ReflectionClass;
use ReflectionFunction;

trait ResolvesMethods
{
    protected function resolveMethod(
        Node\Expr\MethodCall|Node\Expr\NullsafeMethodCall $node
    ) {
        $stanType = $this->getStanType($node);

        if ($stanType !== null) {
            return $stanType;
        }

        $varType = $this->from($node->var);

        if ($varType instanceof ClassType) {
            if (($known = Known::resolve($varType->resolved(), $node->name->name, ...$node->getArgs())) !== false) {
                return RangerType::from($known);
            }

            $returnType = $this->reflector->methodReturnType($varType, $node->name->name, $node);

            // $reflection = $this->reflector->reflectClass($varType->value);

            // $parsed = $this->parser->parse($reflection);

            // $methodNode = $this->parser->nodeFinder()->findFirst(
            //     $parsed,
            //     static fn(Node $n) => $n instanceof Node\Stmt\ClassMethod && $n->name->name === $node->name->name,
            // );

            // return $this->from($methodNode);

            if ($returnType) {
                return $returnType;
            }
        }

        // e.g. config()->string()
        if ($node->var instanceof Node\Expr\FuncCall) {
            $returnType = $this->reflector->functionReturnType($node->var->name->toString(), $node->var);

            $class = collect(explode('|', $returnType?->value ?? ''))
                ->map(fn ($type) => trim($type))
                ->map(fn ($type) => str_replace('.', '\\', $type))
                ->first(fn ($type) => class_exists($type) || interface_exists($type));

            if ($class) {
                return $this->reflector->methodReturnType($class, $node->name->name, $node) ?? RangerType::mixed();
            }
        }

        // e.g. $user->getName()
        if ($node->var instanceof Node\Expr\Variable) {
            $var = $this->from($node->var);

            $isArray = is_array($var);

            $return = collect(Arr::wrap($var))
                ->map(function ($v) use ($node) {
                    if ($v instanceof ClassType) {
                        return $this->getFromClassType($v, $node);
                    }

                    if (is_string($v) && class_exists($v)) {
                        return $this->reflector->methodReturnType($v, $node->name->name, $node) ?? RangerType::mixed();
                    }

                    return RangerType::from($v);
                });

            if ($isArray) {
                return RangerType::union(...$return->unique());
            }

            return $return->first() ?? RangerType::mixed();
        }

        return RangerType::mixed();
    }

    protected function getFromClassType(ClassType $classType, Node\Expr\MethodCall $node): TypeContracd
    {
        $result = $this->reflector->methodReturnType($classType->value, $node->name->name, $node);

        if ($result) {
            return $result;
        }

        if (method_exists($classType->value, $node->name->name)) {
            // We couldn't figure it out...
            return RangerType::mixed();
        }

        if (! method_exists($classType->value, 'hasMacro') || ! $classType->value::hasMacro($node->name->name)) {
            // If the method doesn't exist and the class doesn't have macros, we can't do anything
            return RangerType::mixed();
        }

        $reflection = new ReflectionClass($classType->value);
        $reflectionProperty = $reflection->getProperty('macros');
        $reflectionProperty->setAccessible(true);
        $macros = $reflectionProperty->getValue($reflection);

        $funcReflection = new ReflectionFunction($macros[$node->name->name]);
        // TODO: Should we parse this and ask stan to figure it out?
        $parsed = $this->parser->parse($funcReflection);

        $func = $this->parser->nodeFinder()->findFirst($parsed, fn ($n) => ($n instanceof Node\Expr\Closure || $n instanceof Node\Expr\ArrowFunction) && $n->getStartLine() === $funcReflection->getStartLine());

        $originalParsed = $this->parsed;

        $this->typeResolver->setParsed($parsed);

        $result = $this->from($func);

        $this->typeResolver->setParsed($originalParsed);

        return $result ?? RangerType::mixed();
    }
}
