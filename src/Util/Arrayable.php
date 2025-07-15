<?php

namespace Laravel\Ranger\Util;

use Illuminate\Contracts\Support\Arrayable as ArrayableContract;
use Illuminate\Support\Collection;
use Laravel\Ranger\Debug;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;
use ReflectionClass;
use ReflectionUnionType;
use Throwable;

class Arrayable
{
    protected array $statements = [];

    protected ReflectionClass $reflection;

    protected array $methodStatements = [];

    public function __construct(
        protected Parser $parser,
    ) {
        //
    }

    public function toTypeScript(string $class): ?string
    {
        try {
            $this->reflection = new ReflectionClass($class);

            if (! $this->reflection->implementsInterface(ArrayableContract::class) || ! $this->reflection->hasMethod('toArray')) {
                return null;
            }

            Debug::log("Processing Arrayable {$class}...");

            return $this->getReturnType($this->reflection);
        } catch (Throwable $e) {
            Debug::log("Error converting Arrayable {$class} to TypeScript: {$e->getMessage()}");

            return null;
        }

        return null;
    }

    protected function getReturnType(ReflectionClass $reflection): Collection
    {
        // TODO: Swap this out for the Reflector class
        $this->statements = $this->parser->parse($reflection);
        $this->methodStatements = $this->parser->nodeFinder()->find($this->statements, fn (Node $node) => $node instanceof Node\Stmt\ClassMethod && $node->name->toString() === 'toArray');

        $comment = $this->methodStatements[0]->getDocComment();

        try {
            if ($comment && $result = app(DocBlockParser::class)->parseReturn($comment->getText())) {
                return $result;
            }
        } catch (Throwable $e) {
            //
        }

        return collect($this->parser->nodeFinder()->find($this->methodStatements, fn (Node $node) => $node instanceof Node\Stmt\Return_))
            ->map($this->processReturnType(...))
            ->filter()
            ->values();
    }

    protected function processReturnType(Node\Stmt\Return_ $node): ?array
    {
        if ($node->expr instanceof Node\Expr\Array_) {
            return $this->convertArrayToTypeScript($node->expr);
        }

        return null;
    }

    protected function convertArrayToTypeScript(Node\Expr\Array_ $array): array
    {
        return collect($array->items)->map(function ($item) {
            if ($item->key && $item->key instanceof Node\Scalar\String_) {
                return $item->key->value.': '.$this->resolveValue($item->value ?? null);
            }

            return false;
        })->filter()->map(fn ($i) => TypeScript::indent($i))->all();
    }

    protected function resolveValue($value): ResultContract|array
    {
        if ($value instanceof Node\Scalar\String_) {
            return RangerType::string($value->value)->quote();
        }

        if ($value instanceof Node\Scalar\LNumber || $value instanceof Node\Scalar\DNumber) {
            return RangerType::string((string) $value->value);
        }

        if ($value instanceof Node\Expr\PropertyFetch) {
            if (! $this->reflection->hasProperty($value->name->toString())) {
                return RangerType::mixed();
            }

            $property = $this->reflection->getProperty($value->name->toString());
            $type = $property->getType();

            if ($type instanceof ReflectionUnionType) {
                return RangerType::union(
                    ...collect($type->getTypes())
                        ->map(fn ($t) => RangerType::string($t->getName())->nullable($t->allowsNull()))
                        ->all(),
                );
            }

            return RangerType::string($type->getName())->nullable($type->allowsNull());
        }

        if ($value instanceof Node\Expr\ClassConstFetch) {
            if (! $this->reflection->hasConstant($value->name->toString())) {
                return RangerType::mixed();
            }

            $const = $this->reflection->getConstant($value->name->toString());

            return match (true) {
                is_string($const) => RangerType::string($const)->quote(),
                is_bool($const) => RangerType::bool($const),
                is_null($const) => RangerType::null(),
                default => RangerType::string((string) $const),
            };
        }

        if ($value instanceof Node\Expr\Array_) {
            return $this->convertArrayToTypeScript($value);
        }

        return RangerType::mixed();
    }
}
