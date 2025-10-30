<?php

namespace Laravel\Ranger\Components;

use Laravel\Surveyor\Types\ArrayType;

class InertiaSharedData
{
    public function __construct(
        public readonly ArrayType $data,
    ) {
        //
    }
}
