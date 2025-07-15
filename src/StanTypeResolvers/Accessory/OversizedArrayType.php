<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class OversizedArrayType extends AbstractResolver
{
    public function resolve(Type\Accessory\OversizedArrayType $node): ResultContract
    {
        dd($node, 'OversizedArrayType not implemented yet');
    }
}
