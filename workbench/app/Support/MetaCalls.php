<?php

namespace App\Support;

class MetaCalls
{
    /** @var list<string> */
    public static array $cases = [];

    public static function record(string $case): void
    {
        static::$cases[] = $case;
    }

    public static function flush(): void
    {
        static::$cases = [];
    }
}
