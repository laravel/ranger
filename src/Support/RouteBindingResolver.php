<?php

namespace Laravel\Ranger\Support;

use Illuminate\Database\Eloquent\Model;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\Contracts\Type as TypeContract;

class RouteBindingResolver
{
    protected static $booted = [];

    protected static $analyzed = [];

    /**
     * @return array{0: TypeContract|null, 1: string|null}
     */
    public static function resolveTypeAndKey(string $routable, $key): array
    {
        $booted = self::$booted[$routable] ??= app($routable);

        $key ??= $booted->getRouteKeyName();

        if (! $booted instanceof Model) {
            return [null, $key];
        }

        $result = self::$analyzed[$routable] ??= app(Analyzer::class)->analyzeClass($routable)->result();

        if ($result === null || ! $result->hasProperty($key)) {
            return [null, $key];
        }

        return [$result->getProperty($key)->type, $key];
    }
}
