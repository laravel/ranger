<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AccessoryNumericStringType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryNumericStringType $node): ResultContract
    {
        dd($node, 'AccessoryNumericStringType not implemented yet');
    }
}
