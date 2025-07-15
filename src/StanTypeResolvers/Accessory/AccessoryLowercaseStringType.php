<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AccessoryLowercaseStringType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryLowercaseStringType $node): ResultContract
    {
        dd($node, 'AccessoryLowercaseStringType not implemented yet');
    }
}
