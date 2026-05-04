<?php

namespace Laravel\Ranger\Components;

class JsonApiResponse
{
    public function __construct(
        public readonly string $resourceClass,
        public readonly array $attributes,
        public readonly array $relationships,
        public readonly array $links,
        public readonly array $meta,
        public readonly bool $isCollection,
    ) {
        //
    }
}
