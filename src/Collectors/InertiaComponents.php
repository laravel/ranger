<?php

namespace Laravel\Ranger\Collectors;

use Laravel\Ranger\Components\InertiaResponse;
use Laravel\Surveyor\Analyzer\ArrayableResolver;
use Laravel\Surveyor\Result\VariableState;
use Laravel\Surveyor\Types\ArrayShapeType;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\CallableType;
use Laravel\Surveyor\Types\ClassType;
use Laravel\Surveyor\Types\Contracts\Type as TypeContract;
use Laravel\Surveyor\Types\Type;
use Laravel\Surveyor\Types\UnionType;

class InertiaComponents
{
    /**
     * @var array<string, array<string, Type>>
     */
    protected static array $components = [];

    public static function addComponent(string $component, TypeContract $data): void
    {
        if ($data instanceof UnionType) {
            foreach ($data->types as $type) {
                self::addComponent($component, $type);
            }

            return;
        }

        if (! $data instanceof ArrayType && ! $data instanceof ArrayShapeType) {
            return;
        }

        $data = $data instanceof ArrayShapeType ? new ArrayType([]) : $data;

        self::$components[$component] = self::mergeComponentData($component, self::getComponentData($component), $data);
    }

    public static function getComponent(string $component): InertiaResponse
    {
        return new InertiaResponse($component, self::getComponentData($component));
    }

    protected static function getComponentData(string $component): array
    {
        return self::$components[$component] ?? [];
    }

    protected static function hasComponent(string $component): bool
    {
        return isset(self::$components[$component]);
    }

    protected static function mergeComponentData(string $component, array $existingData, ArrayType $data): array
    {
        $resolver = app(ArrayableResolver::class);
        $data = self::normalizeData($data, $resolver);

        if (! self::hasComponent($component)) {
            return $data->value;
        }

        $same = array_intersect($data->keys(), array_keys($existingData));

        foreach ($existingData as $key => $value) {
            if (! in_array($key, $same)) {
                $value->optional();
            }
        }

        foreach ($data->value as $key => $value) {
            if (in_array($key, $same)) {
                if (get_class($value) !== get_class($existingData[$key])) {
                    $value1 = $value instanceof UnionType ? $value->types : [$value];
                    $value2 = $existingData[$key] instanceof UnionType ? $existingData[$key]->types : [$existingData[$key]];
                    $existingData[$key] = Type::union(...$value1, ...$value2);
                }
            } else {
                $value->optional();
                $existingData[$key] = $value;
            }

            if ($value instanceof ArrayType && ($existingData[$key] ?? null) instanceof ArrayType) {
                $newValue = self::mergeComponentData(
                    $component,
                    $existingData[$key]->value,
                    $value,
                );

                $existingData[$key] = (new ArrayType($newValue))->optional($value->isOptional());
            }

            if ($value instanceof CallableType) {
                $existingData[$key] = $value->returnType;
            }
        }

        return $existingData;
    }

    protected static function normalizeData(ArrayType $data, ArrayableResolver $resolver): ArrayType
    {
        $normalized = [];

        foreach ($data->value as $key => $value) {
            $normalized[$key] = self::normalizeValue($value, $resolver);
        }

        return (new ArrayType($normalized))
            ->optional($data->isOptional())
            ->nullable($data->isNullable());
    }

    protected static function normalizeValue(TypeContract|VariableState $value, ArrayableResolver $resolver): TypeContract
    {
        if ($value instanceof VariableState) {
            $value = $value->type();
        }

        if ($value instanceof ClassType && $resolved = $resolver->resolve($value)) {
            return $resolved
                ->optional($value->isOptional())
                ->nullable($value->isNullable());
        }

        if ($value instanceof ArrayType) {
            return self::normalizeData($value, $resolver);
        }

        if ($value instanceof ArrayShapeType) {
            return (new ArrayShapeType(
                self::normalizeValue($value->keyType, $resolver),
                self::normalizeValue($value->valueType, $resolver),
            ))
                ->optional($value->isOptional())
                ->nullable($value->isNullable());
        }

        if ($value instanceof UnionType) {
            return Type::union(...array_map(
                fn ($type) => self::normalizeValue($type, $resolver),
                $value->types,
            ))
                ->optional($value->isOptional())
                ->nullable($value->isNullable());
        }

        return $value;
    }
}
