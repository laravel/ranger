<?php

namespace Laravel\Ranger\Types;

class StringType extends AbstractType implements Contracts\Type
{
    public function __construct(public readonly ?string $value = null)
    {
        //
    }
}
