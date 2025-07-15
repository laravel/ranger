<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class IntegerRangeType extends AbstractResolver
{
    public function resolve(Type\IntegerRangeType $node): ResultContract
    {
        return RangerType::int();
    }
}
