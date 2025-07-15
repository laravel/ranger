<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HasOffsetType extends AbstractResolver
{
    public function resolve(Type\Accessory\HasOffsetType $node): ResultContract
    {
        dd($node, 'HasOffsetType not implemented yet');
    }
}
