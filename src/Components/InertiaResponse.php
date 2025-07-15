<?php

namespace Laravel\Ranger\Components;

class InertiaResponse
{
    public function __construct(
        public readonly string $component,
        public readonly array $data,
    ) {
        //
    }
}
