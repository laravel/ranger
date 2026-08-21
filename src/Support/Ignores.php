<?php

namespace Laravel\Ranger\Support;

use Laravel\Surveyor\Analyzed\IgnoreMarker;
use Laravel\Surveyor\Support\Markers;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use ReflectionMethod;
use ReflectionProperty;
use Throwable;

class Ignores
{
    /**
     * Whether a declaration should be left out right now. Used for the things
     * found by reflection rather than by reading the file, such as a route's
     * controller method or an enum case.
     */
    public static function marked(
        ReflectionClass|ReflectionClassConstant|ReflectionEnum|ReflectionEnumBackedCase|ReflectionEnumUnitCase|ReflectionMethod|ReflectionProperty $reflection,
    ): bool {
        return static::marker($reflection)?->hides() ?? false;
    }

    public static function marker(
        ReflectionClass|ReflectionClassConstant|ReflectionEnum|ReflectionEnumBackedCase|ReflectionEnumUnitCase|ReflectionMethod|ReflectionProperty $reflection,
    ): ?IgnoreMarker {
        return Markers::fromReflection($reflection);
    }

    /**
     * @param  class-string|string  $class
     */
    public static function markedClass(string $class): bool
    {
        return class_exists($class) && static::marked(new ReflectionClass($class));
    }

    /**
     * Resolve a marker condition: a config key or a [class, method] callable.
     * Anything else keeps the declaration hidden.
     */
    public static function evaluate(string|array $condition): bool
    {
        if (is_string($condition)) {
            return (bool) config($condition, false);
        }

        if (count($condition) !== 2) {
            return false;
        }

        [$class, $method] = $condition;

        if (! is_string($class) || ! is_string($method) || ! method_exists($class, $method)) {
            return false;
        }

        try {
            return (bool) app()->call([$class, $method]);
        } catch (Throwable) {
            return false;
        }
    }
}
