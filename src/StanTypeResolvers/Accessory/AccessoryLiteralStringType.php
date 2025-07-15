<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AccessoryLiteralStringType extends AbstractResolver
{
    public function resolve(Type\Accessory\AccessoryLiteralStringType $node): ResultContract
    {
        dd($node, 'AccessoryLiteralStringType not implemented yet');
    }
}
