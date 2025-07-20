<?php

namespace Laravel\Ranger\Collectors;

use Laravel\Ranger\Components\InertiaResponse;
use Laravel\Ranger\Types\ArrayType;
use Laravel\Ranger\Types\Type;
use Laravel\Ranger\Types\UnionType;

class InertiaComponents
{
    protected static array $components = [];

    public static function addComponent(string $component, array $data): void
    {
        if (isset(self::$components[$component])) {
            self::$components[$component] = self::mergeComponentData(self::$components[$component], $data);
        } else {
            self::$components[$component] = $data;
        }
    }

    public static function getComponent(string $component): InertiaResponse
    {
        return new InertiaResponse($component, self::$components[$component] ?? []);
    }

    protected static function mergeComponentData(array $existingData, array $data): mixed
    {
        $newKeys = $data instanceof ArrayType
            ? $data->keys()->all()
            : array_keys($data);

        $existingKeys = $existingData instanceof ArrayType
            ? $existingData->keys()->all()
            : array_keys($existingData);

        $same = array_intersect($newKeys, $existingKeys);

        foreach ($existingData as $key => $value) {
            if (! in_array($key, $same)) {
                $value->optional();
            }
        }

        foreach ($data as $key => $value) {
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
                $existingData[$key] = (new ArrayType(
                    self::mergeComponentData(
                        $existingData[$key]->value ?? [],
                        $value->value
                    ),
                ))->optional($value->isOptional());
            }
        }

        return $existingData;
    }
}
