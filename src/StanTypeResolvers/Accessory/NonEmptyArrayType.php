<?php

namespace Laravel\Ranger\StanTypeResolvers\Accessory;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use PHPStan\Type;

class NonEmptyArrayType extends AbstractResolver
{
    public function resolve(Type\Accessory\NonEmptyArrayType $node): ?Result
    {
        return null;
    }
}
