<?php

namespace Laravel\Ranger\Support;

class Config
{
    protected static array $config = [];

    public static function set(string $key, mixed $value): void
    {
        static::$config[$key] = $value;
    }

    public static function get(string $key, mixed $default = null)
    {
        return static::$config[$key] ?? $default;
    }
}
