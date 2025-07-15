<?php

namespace Laravel\Ranger\Util;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use Laravel\Ranger\Collectors\Models as CollectorsModels;
use Laravel\Ranger\Types\ClassType;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;
use PhpParser\Node\Expr\CallLike;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionUnionType;
use Throwable;

class Reflector
{
    public function __construct(
        protected DocBlockParser $docBlockParser,
        protected Parser $parser,
        protected Stan $stan,
    ) {
        //
    }

    public function functionReturnType(string|ReflectionFunction $func, ?CallLike $node = null): string|array|ResultContract|null
    {
        $reflection = is_string($func) ? new ReflectionFunction($func) : $func;

        if ($reflection->getDocComment()) {
            // Let's assume the docblock comment is more specific than the return type
            $returnType = $this->docBlockParser->parseReturn($reflection->getDocComment(), $node);

            if ($returnType) {
                if ($returnType instanceof Collection) {
                    return $returnType->all();
                }

                return $returnType;
            }
        }

        if ($reflection->hasReturnType()) {
            return $this->returnType($reflection->getReturnType());
        }

        return null;
    }

    public function methodReturnType(string|ReflectionClass|ClassType $class, string $method, ?CallLike $methodNode = null): ?ResultContract
    {
        try {
            $className = match (true) {
                $class instanceof ReflectionClass => $class->getName(),
                $class instanceof ClassType => $class->value,
                default => $class,
            };

            // $reflectedClass = $this->reflectClass($className);
            // $parsed = $this->parser->parse($reflectedClass);

            // $methodNode = $this->parser->nodeFinder()->findFirst(
            //     $parsed,
            //     fn($n) => $n instanceof ClassMethod && $n->name instanceof Identifier && $n->name->toString() === $method
            // );

            // $returnNodes = $this->parser->nodeFinder()->find(
            //     $methodNode,
            //     static function (Node $n) use ($methodNode): bool {
            //         // pick only Return_ nodes
            //         if (!($n instanceof Return_)) {
            //             return false;
            //         }

            //         // walk up until we hit the first FunctionLike ancestor
            //         $parent = $n->getAttribute('parent');

            //         while ($parent && !($parent instanceof FunctionLike)) {
            //             $parent = $parent->getAttribute('parent');
            //         }

            //         // keep the Return_ only if that first FunctionLike is the method itself
            //         return $parent === $methodNode;
            //     }
            // );

            // return RangerType::union(...array_map(
            //     fn($n) => $this->stan->getType($n),
            //     $returnNodes,
            // ));

            $method = $this->reflectMethod($className, $method);
        } catch (Throwable $e) {
            return null;
        }

        if ($method->getDocComment()) {
            // Let's assume the docblock comment is more specific than the return type
            // $this->parser->nodeFinder()->findFirst($this->parser->parse($method), fn($n) => $n instanceof MethodCall && $n->name instanceof Identifier && $n->name->toString() === $method)
            $returnType = $this->docBlockParser->parseReturn($method->getDocComment());

            if ($returnType === '$this') {
                return $class;
            }

            if ($returnType) {
                return RangerType::union(...$returnType);
            }
        }

        if ($method->hasReturnType()) {
            return $this->returnType($method->getReturnType());
        }

        return null;
    }

    public function reflectClass(string|ReflectionClass $class): ReflectionClass
    {
        if ($class instanceof ReflectionClass) {
            return $class;
        }

        if (is_string($class) && interface_exists($class)) {
            $bindings = app()->getBindings();
            $aliasClass = ltrim($class, '\\');
            $isAlias = app()->isAlias($aliasClass);

            if (array_key_exists($class, $bindings)) {
                $class = $bindings[$class]['concrete'];
            } elseif ($isAlias) {
                $class = get_class(app(app()->getAlias($aliasClass)));
            }
        }

        if (! class_exists($class)) {
            throw new InvalidArgumentException("Class {$class} does not exist.");
        }

        return new ReflectionClass($class);
    }

    public function reflectMethod(string|ReflectionClass $class, string $method): ReflectionMethod
    {
        $reflection = $this->reflectClass($class);

        if (! $reflection->hasMethod($method)) {
            throw new InvalidArgumentException("Method {$method} does not exist in class {$class}.");
        }

        return $reflection->getMethod($method);
    }

    public function methodParamType(string $class, string $method, string $paramName)
    {
        try {
            $reflection = $this->reflectMethod($class, $method);
        } catch (Throwable $e) {
            return null;
        }

        $param = collect($reflection->getParameters())
            ->first(fn ($param) => $param->getName() === $paramName);

        if ($param && $param->hasType()) {
            return $this->returnType($param->getType());
        }

        return null;
    }

    public function returnType(ReflectionNamedType|ReflectionUnionType $returnType): ?ResultContract
    {
        if ($returnType instanceof ReflectionNamedType) {
            return RangerType::from($returnType->getName());
        }

        if ($returnType instanceof ReflectionUnionType) {
            return RangerType::union(
                ...collect($returnType->getTypes())
                    ->map(fn ($t) => RangerType::from($t->getName())),
            );
        }

        return null;
    }

    public function propertyType(string|ReflectionClass|ClassType $class, string $property): ?ResultContract
    {
        $class = match (true) {
            $class instanceof ClassType => $class->value,
            default => $class,
        };

        if (is_string($class)) {
            $model = app(CollectorsModels::class)->getCollection()->first(fn ($m) => $m->name === $class);

            if ($model) {
                return $model->getAttributes()[$property] ?? $model->getRelations()[$property] ?? null;
            }
        }

        try {
            $reflection = $this->reflectClass($class);
        } catch (Throwable $e) {
            return null;
        }

        if (! $reflection->hasProperty($property)) {
            return null;
        }

        $prop = $reflection->getProperty($property);

        if ($prop->getDocComment()) {
            // Let's assume the docblock comment is more specific than the property type
            $returnType = $this->docBlockParser->parseVar($prop->getDocComment());

            if ($returnType) {
                return $returnType;
            }
        }

        if ($prop->hasType()) {
            return $this->returnType($prop->getType());
        }

        return null;
    }
}
