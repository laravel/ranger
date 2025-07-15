<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantBooleanType extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantBooleanType $node): ResultContract
    {
        dd($node, 'ConstantBooleanType not implemented yet');
    }
}
