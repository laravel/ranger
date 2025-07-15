<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantFloatType extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantFloatType $node): ResultContract
    {
        dd($node, 'ConstantFloatType not implemented yet');
    }
}
