<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HasOffsetValueType extends AbstractResolver
{
    public function resolve(Type\Accessory\HasOffsetValueType $node): ResultContract
    {
        dd($node, 'HasOffsetValueType not implemented yet');
    }
}
