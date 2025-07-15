<?php

namespace Laravel\Ranger\Types;

use Illuminate\Support\Collection;

class GenericObjectType extends AbstractType implements Contracts\Type
{
    public function __construct(
        public readonly string $base,
        public readonly array|Collection $types,
    ) {
        //
    }
}
