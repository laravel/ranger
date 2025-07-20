<?php

namespace Laravel\Ranger\Components;

class JsonResponse
{
    public function __construct(
        public readonly array $data,
    ) {
        //
    }
}
