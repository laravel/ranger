<?php

namespace Laravel\Ranger\Components;

use Laravel\Ranger\Concerns\HasFilePath;

class Enum
{
    use HasFilePath;

    /**
     * @param  array<string, int|string|null>  $cases
     */
    public function __construct(
        public readonly string $name,
        public readonly array $cases
    ) {
        //
    }
}
