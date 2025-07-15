<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class NullType extends AbstractResolver
{
    public function resolve(Type\NullType $node): ResultContract
    {
        return RangerType::null();
    }
}
