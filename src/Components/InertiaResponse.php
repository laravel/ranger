<?php

namespace Laravel\Ranger\Components;

use Laravel\Surveyor\Types\Contracts\Type;

class InertiaResponse
{
    /**
     * @param  array<string, Type>  $data
     */
    public function __construct(
        public readonly string $component,
        public readonly array $data,
    ) {
        //
    }
}
