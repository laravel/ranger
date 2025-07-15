<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\ArrayResult;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use Laravel\Ranger\Util\TypeResolver;
use PhpParser\Node\Stmt\Use_;
use PHPStan\PhpDocParser\Ast;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;

class GenericTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\GenericTypeNode $node): ResultContract
    {
        $base = $this->resolveBase($node->type->name);

        // TODO: Fix this, maybe we don't need docblock parser with stan??
        return RangerType::generic(
            $base,
            collect($node->genericTypes)->map(
                fn ($n) => $n instanceof IdentifierTypeNode ? RangerType::string($this->resolveBase($n->name)) : $this->from($n),
            )->all()
        );

        // $baseType = $this->from($node->type);
        // $genericArguments = $this->resolveGenericArguments($node->genericTypes);

        // if (empty($genericArguments)) {
        //     return $baseType;
        // }

        // return RangerType::from($this->formatGenericType($baseType, $genericArguments));
    }

    protected function resolveBase(string $baseName): ResultContract|string
    {
        if (class_exists($baseName) || interface_exists($baseName)) {
            return $baseName;
        }

        if (! $this->referenceNode) {
            return $baseName;
        }

        $parent = $this->referenceNode->getAttribute('parent');

        while ($parent->getAttribute('parent')) {
            $parent = $parent->getAttribute('parent');
        }

        $result = collect($this->parser->nodeFinder()->find($parent, fn ($n) => $n instanceof Use_))
            ->map(fn ($n) => $n->uses)
            ->flatten()
            ->map(function ($use) use ($baseName) {
                $name = $use->name->toString();

                if ($baseName === 'Collection') {
                    dd($name, debug_backtrace(limit: 20));
                }

                if ($baseName === $name) {
                    return $name;
                }

                if (str_ends_with($name, '\\'.$baseName)) {
                    return $name;
                }

                if ($use->alias?->name === $baseName) {
                    return $name;
                }

                return null;
            })->filter()->first();

        return $result ?? $baseName;
    }

    protected function resolveGenericArguments(array $genericTypes): array
    {
        $resolvedTypes = [];

        foreach ($genericTypes as $genericType) {
            $resolvedTypes[] = $this->resolveGenericArgument($genericType);
        }

        return $resolvedTypes;
    }

    protected function resolveGenericArgument($genericType): ResultContract|string
    {
        if ($genericType instanceof Ast\Type\IdentifierTypeNode) {
            return $this->resolveIdentifierType($genericType);
        }

        return $this->from($genericType);
    }

    protected function resolveIdentifierType(Ast\Type\IdentifierTypeNode $identifierType): ResultContract|string
    {
        $typeName = (string) $identifierType->name;

        $templateType = $this->findTemplateType($typeName);
        if ($templateType !== null) {
            return $templateType;
        }

        $concreteType = $this->inferConcreteType($typeName);
        if ($concreteType !== null) {
            return $concreteType;
        }

        return $this->from($identifierType);
    }

    protected function findTemplateType(string $templateName): ?string
    {
        $templates = $this->parsed->getTemplateTagValues();

        foreach ($templates as $index => $template) {
            if ($template->name === $templateName) {
                return $this->resolveTemplateFromContext($templateName, $index);
            }
        }

        return null;
    }

    protected function resolveTemplateFromContext(string $templateName, int $templateIndex): string
    {
        if (! $this->referenceNode) {
            return $templateName;
        }

        $args = $this->referenceNode->getArgs();

        $concreteType = $this->inferFromArgument($args, $templateIndex);

        if ($concreteType !== null) {
            return $concreteType;
        }

        $concreteType = $this->inferFromNamedArgument($args, $templateName);
        if ($concreteType !== null) {
            return $concreteType;
        }

        return $templateName;
    }

    protected function inferFromArgument(array $args, int $index): ?string
    {
        if (! isset($args[$index])) {
            return null;
        }

        $arg = $args[$index];

        return $this->analyzeArgumentType($arg->value);
    }

    protected function inferFromNamedArgument(array $args, string $templateName): ?string
    {
        foreach ($args as $arg) {
            if ($arg->name && $arg->name->name === $templateName) {
                return $this->analyzeArgumentType($arg->value);
            }
        }

        return null;
    }

    protected function analyzeArgumentType($value): string
    {
        return app(TypeResolver::class)->from($value);
    }

    protected function inferConcreteType(string $typeName): ?string
    {
        if (! $this->referenceNode) {
            return null;
        }

        $paramTypes = $this->parsed->getParamTagValues();

        foreach ($paramTypes as $index => $paramType) {
            if (
                $paramType->type instanceof Ast\Type\IdentifierTypeNode &&
                (string) $paramType->type->name === $typeName
            ) {

                $args = $this->referenceNode->getArgs();
                if (isset($args[$index])) {
                    return $this->analyzeArgumentType($args[$index]->value);
                }
            }
        }

        return null;
    }

    protected function formatGenericType(string|ResultContract $baseType, array $genericArguments): string|Result
    {
        if (empty($genericArguments)) {
            return $baseType;
        }

        if ($this->isArrayLikeType($baseType)) {
            return $this->formatArrayLikeType($baseType, $genericArguments);
        }

        if ($this->isIterableLikeType($baseType)) {
            return $this->formatIterableLikeType($baseType, $genericArguments);
        }

        if ($baseType === 'class-string') {
            return class_exists($genericArguments[0]) ? $genericArguments[0] : 'string';
        }

        $genericTypesString = implode(', ', $genericArguments);

        return "{$baseType}<{$genericTypesString}>";
    }

    protected function isArrayLikeType(string|ResultContract $type): bool
    {
        if ($type instanceof ArrayResult) {
            return true;
        }

        return in_array(is_string($type) ? $type : '', ['array', 'Array']);
    }

    protected function isIterableLikeType(string|ResultContract $type): bool
    {
        if (! is_string($type)) {
            return false;
        }

        return in_array($type, ['Iterator', 'Traversable', 'Iterable', 'Generator']);
    }

    protected function formatArrayLikeType(string|ResultContract $baseType, array $genericArguments): string
    {
        if (count($genericArguments) === 1) {
            return "{$genericArguments[0]}[]";
        }

        if (count($genericArguments) === 2) {
            $keyType = $genericArguments[0];
            $valueType = $genericArguments[1];

            if ($keyType === 'number' || $keyType === 'integer') {
                return "{$valueType}[]";
            }

            return "Record<{$keyType}, {$valueType}>";
        }

        $genericTypesString = implode(', ', $genericArguments);

        return "{$baseType}<{$genericTypesString}>";
    }

    protected function formatIterableLikeType(string $baseType, array $genericArguments): string
    {
        if (count($genericArguments) === 1) {
            return "Iterable<{$genericArguments[0]}>";
        }

        if (count($genericArguments) === 2) {
            return "Iterable<{$genericArguments[0]}, {$genericArguments[1]}>";
        }

        $genericTypesString = implode(', ', $genericArguments);

        return "{$baseType}<{$genericTypesString}>";
    }
}
