<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class GenericObjectType extends AbstractResolver
{
    public function resolve(Type\Generic\GenericObjectType $node): ResultContract
    {
        return RangerType::generic(
            $node->getClassName(),
            collect($node->getTypes())->map(fn ($type) => $this->from($type))
        );
    }
}
