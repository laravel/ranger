<?php

namespace Laravel\Ranger\Types;

class IntersectionType extends AbstractType implements Contracts\Type
{
    public function __construct(public readonly array $types = [])
    {
        //
    }
}
