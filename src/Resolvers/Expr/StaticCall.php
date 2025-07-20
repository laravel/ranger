<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Known\Known;
use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\ClassType;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class StaticCall extends AbstractResolver
{
    public function resolve(Node\Expr\StaticCall $node): ResultContract
    {
        if (($known = Known::resolve($node->class->toString(), $node->name->name, ...$node->getArgs())) !== false) {
            return RangerType::from($known);
        }

        $stanType = $this->getStanType($node);

        if ($stanType instanceof ClassType) {
            $return = match ($stanType->value) {
                'Inertia\\LazyProp' => RangerType::from($this->from($node->getArgs()[0]))->optional(),
                'Inertia\\AlwaysProp' => RangerType::from($this->from($node->getArgs()[0])),
                default => null,
            };

            if ($return) {
                return $return;
            }
        }

        if ($stanType !== null) {
            return $stanType;
        }

        $varType = $this->from($node->class);

        if ($varType instanceof ClassType || (is_string($varType) && class_exists($varType))) {
            $classVarType = $varType instanceof ClassType ? $varType->resolved() : $varType;

            if ($classVarType !== $varType) {
                $reflection = $this->reflector->reflectClass($classVarType);

                $parsed = $this->parser->parse($reflection);

                $methodNode = $this->parser->nodeFinder()->findFirst(
                    $parsed,
                    static fn (Node $n) => $n instanceof Node\Stmt\ClassMethod && $n->name->name === $node->name->name,
                );

                return $this->from($methodNode);
            }

            $returnType = $this->reflector->methodReturnType($classVarType, $node->name->name, $node);

            if ($returnType) {
                return $returnType;
            }
        }

        return RangerType::mixed();
    }
}
