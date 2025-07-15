<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AccessoryUppercaseStringType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryUppercaseStringType $node): ResultContract
    {
        dd($node, 'AccessoryUppercaseStringType not implemented yet');
    }
}
