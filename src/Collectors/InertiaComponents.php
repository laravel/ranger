<?php

namespace Laravel\Ranger\Collectors;

use Laravel\Ranger\Components\InertiaResponse;
use Laravel\Surveyor\Types\ArrayShapeType;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\CallableType;
use Laravel\Surveyor\Types\Type;
use Laravel\Surveyor\Types\UnionType;

class InertiaComponents
{
    protected static array $components = [];

    public static function addComponent(string $component, ArrayType|ArrayShapeType $data): void
    {
        if ($data instanceof ArrayShapeType) {
            return;
        }

        self::$components[$component] = self::mergeComponentData(
            self::$components[$component] ?? [],
            $data,
        );
    }

    public static function getComponent(string $component): InertiaResponse
    {
        $data = self::$components[$component] ?? [];

        return new InertiaResponse($component, $data);
    }

    protected static function mergeComponentData(array $existingData, ArrayType $data): array
    {
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

            if ($value instanceof ArrayType) {
                $existingValue = $existingData[$key] ?? [];
                $newValue = self::mergeComponentData(
                    $existingValue instanceof ArrayType ? $existingValue->value : $existingValue,
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
}
