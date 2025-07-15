<?php

namespace Laravel\Ranger\Types;

class BoolType extends AbstractType implements Contracts\Type
{
    public function __construct(public readonly ?bool $value = null)
    {
        //
    }
}
