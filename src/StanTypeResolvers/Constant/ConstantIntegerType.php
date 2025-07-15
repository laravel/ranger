<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantIntegerType extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantIntegerType $node): ResultContract
    {
        dd($node, 'ConstantIntegerType not implemented yet');
    }
}
