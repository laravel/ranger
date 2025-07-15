<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class StringType extends AbstractResolver
{
    public function resolve(Type\StringType $node): ResultContract
    {
        return RangerType::string();
    }
}
