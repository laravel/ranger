<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AccessoryNonEmptyStringType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryNonEmptyStringType $node): ResultContract
    {
        dd($node, 'AccessoryNonEmptyStringType not implemented yet');
    }
}
