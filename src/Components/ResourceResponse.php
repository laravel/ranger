<?php

namespace Laravel\Ranger\Components;

class ResourceResponse
{
    public function __construct(
        public readonly string $resourceClass,
        public readonly array $data,
        public readonly bool $isCollection,
        public readonly ?string $wrap,
        public readonly array $additional = [],
    ) {
        //
    }
}
