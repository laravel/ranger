<?php

namespace Laravel\Ranger\Types;

use Illuminate\Support\Collection;

class Type
{
    public static function mixed(): Contracts\Type
    {
        return new MixedType;
    }

    public static function array($value): Contracts\Type
    {
        return new ArrayType($value);
    }

    public static function string(?string $value = null): Contracts\Type
    {
        if ($value !== null && (class_exists($value) || interface_exists($value))) {
            return new ClassType($value);
        }

        return new StringType($value);
    }

    public static function generic(string $base, array|Collection $types): Contracts\Type
    {
        return new GenericObjectType($base, $types);
    }

    public static function int(): Contracts\Type
    {
        return new IntType;
    }

    public static function bool(?bool $bool = null): Contracts\Type
    {
        return new BoolType($bool);
    }

    public static function arrayShape(mixed $keyType, mixed $itemType): Contracts\Type
    {
        return new ArrayShapeType($keyType, $itemType);
    }

    public static function null(): Contracts\Type
    {
        return new NullType;
    }

    public static function from(mixed $value): Contracts\Type
    {
        if ($value instanceof Contracts\Type) {
            return $value;
        }

        if (is_string($value)) {
            if ($value === 'array') {
                return self::array([]);
            }

            if (method_exists(self::class, $value)) {
                return self::$value();
            }

            return self::string($value);
        }

        dd('something else from', $value, debug_backtrace(limit: 3));
    }

    public static function union(...$args): Contracts\Type
    {
        if (count($args) === 1) {
            return $args[0];
        }

        return new UnionType($args);
    }

    public static function intersection(...$args): Contracts\Type
    {
        if (count($args) === 1) {
            return $args[0];
        }

        return new IntersectionType($args);
    }
}
