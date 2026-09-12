<?php

namespace Laravel\Ranger\Components;

use Laravel\Surveyor\Types\Contracts\Type;

class ResourceResponse
{
    public function __construct(
        public readonly string $resourceClass,
        public readonly array|Type $data,
        public readonly bool $isCollection,
        public readonly ?string $wrap,
        public readonly array $additional = [],
    ) {
        //
    }
}
