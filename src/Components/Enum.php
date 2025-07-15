<?php

namespace Laravel\Ranger\Components;

class Enum
{
    public function __construct(
        public readonly string $name,
        public readonly array $cases
    ) {
        //
    }
}
