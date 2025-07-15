<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class ObjectType extends AbstractResolver
{
    public function resolve(Type\ObjectType $node): ResultContract
    {
        return RangerType::string($node->getClassName());
    }
}
