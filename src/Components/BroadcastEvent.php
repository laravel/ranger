<?php

namespace Laravel\Ranger\Components;

use Laravel\Ranger\Concerns\HasFilePath;
use Laravel\Surveyor\Types\Contracts\Type;

class BroadcastEvent
{
    use HasFilePath;

    public function __construct(
        public readonly string $name,
        public readonly string $className,
        public readonly Type $data,
    ) {
        //
    }
}
