<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class MixedType extends AbstractResolver
{
    public function resolve(Type\MixedType $node): ResultContract
    {
        return RangerType::mixed();
    }
}
