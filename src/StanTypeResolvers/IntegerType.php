<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class IntegerType extends AbstractResolver
{
    public function resolve(Type\IntegerType $node): ResultContract
    {
        return RangerType::int();
    }
}
