<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantArrayTypeAndMethod extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantArrayTypeAndMethod $node): ResultContract
    {
        dd($node, 'ConstantArrayTypeAndMethod not implemented yet');
    }
}
