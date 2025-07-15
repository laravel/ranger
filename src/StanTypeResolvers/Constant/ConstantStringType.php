<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class ConstantStringType extends AbstractResolver
{
    public function resolve(Type\Constant\ConstantStringType $node): ResultContract
    {
        return RangerType::string($node->getValue());
    }
}
