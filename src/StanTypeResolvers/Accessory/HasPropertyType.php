<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HasPropertyType extends AbstractResolver
{
    public function resolve(Type\Accessory\HasPropertyType $node): ResultContract
    {
        dd($node, 'HasPropertyType not implemented yet');
    }
}
