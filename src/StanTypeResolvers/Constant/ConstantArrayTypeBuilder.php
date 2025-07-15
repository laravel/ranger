<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantArrayTypeBuilder extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantArrayTypeBuilder $node): ResultContract
    {
        dd($node, 'ConstantArrayTypeBuilder not implemented yet');
    }
}
