<?php

namespace Laravel\Ranger\Types;

class UnionType extends AbstractType implements Contracts\Type
{
    public function __construct(public readonly array $types = [])
    {
        //
    }
}
