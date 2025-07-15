<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HasMethodType extends AbstractResolver
{
    public function resolve(Type\Accessory\HasMethodType $node): ResultContract
    {
        dd($node, 'HasMethodType not implemented yet');
    }
}
