<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class BooleanType extends AbstractResolver
{
    public function resolve(Type\BooleanType $node): ResultContract
    {
        return RangerType::bool();
    }
}
