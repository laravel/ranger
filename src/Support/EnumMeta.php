<?php

namespace Laravel\Ranger\Support;

use BackedEnum;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use ReflectionEnum;
use ReflectionMethod;
use ReflectionNamedType;
use Stringable;
use Throwable;
use UnitEnum;

class EnumMeta
{
    protected const MAX_DEPTH = 10;

    /**
     * Resolve the value of every no-argument method for every case.
     *
     * The returned array is keyed by case name, then by method name. A method
     * that throws or returns something we cannot represent is left out for that
     * case alone, so methods that only cover some of the cases still make it
     * through.
     *
     * @param  class-string<UnitEnum>  $enum
     * @param  list<string>  $cases  Names of the cases to resolve; the rest are left alone.
     * @return array<string, array<string, mixed>>
     */
    public static function resolve(string $enum, array $cases): array
    {
        $methods = self::eligibleMethods($enum);

        if ($methods === [] || $cases === []) {
            return [];
        }

        $resolved = [];

        foreach ($enum::cases() as $case) {
            if (! in_array($case->name, $cases, true)) {
                continue;
            }

            foreach ($methods as $method) {
                try {
                    $value = self::normalize($case->{$method}());
                } catch (Throwable) {
                    continue;
                }

                $resolved[$case->name][$method] = $value;
            }
        }

        return $resolved;
    }

    /**
     * @param  class-string<UnitEnum>  $enum
     * @return list<string>
     */
    protected static function eligibleMethods(string $enum): array
    {
        $reflection = new ReflectionEnum($enum);

        return collect($reflection->getMethods(ReflectionMethod::IS_PUBLIC))
            ->reject(fn (ReflectionMethod $method) => $method->isStatic()
                || $method->getDeclaringClass()->getName() !== $reflection->getName()
                || str_starts_with($method->getName(), '__')
                || $method->getNumberOfRequiredParameters() > 0
                || $method->isGenerator()
                || self::returnsNothing($method)
                || Ignores::marked($method))
            ->map(fn (ReflectionMethod $method) => $method->getName())
            ->values()
            ->all();
    }

    protected static function returnsNothing(ReflectionMethod $method): bool
    {
        $type = $method->getReturnType();

        return $type instanceof ReflectionNamedType
            && in_array(strtolower($type->getName()), ['void', 'never'], true);
    }

    protected static function normalize(mixed $value, int $depth = 0): mixed
    {
        if ($depth > self::MAX_DEPTH) {
            throw new UnsupportedEnumMetaValue;
        }

        if ($value === null || is_bool($value) || is_int($value) || is_string($value)) {
            return $value;
        }

        if (is_float($value)) {
            if (! is_finite($value)) {
                throw new UnsupportedEnumMetaValue;
            }

            return $value;
        }

        if (is_array($value)) {
            return array_map(fn ($item) => self::normalize($item, $depth + 1), $value);
        }

        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if ($value instanceof JsonSerializable) {
            return self::normalize($value->jsonSerialize(), $depth + 1);
        }

        if ($value instanceof Arrayable) {
            return self::normalize($value->toArray(), $depth + 1);
        }

        if ($value instanceof Stringable) {
            return (string) $value;
        }

        throw new UnsupportedEnumMetaValue;
    }
}
