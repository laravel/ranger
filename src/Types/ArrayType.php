<?php

namespace Laravel\Ranger\Types;

use Illuminate\Support\Collection;

class ArrayType extends AbstractType implements Contracts\Type
{
    public function __construct(public readonly array|Collection $value)
    {
        //
    }
}
