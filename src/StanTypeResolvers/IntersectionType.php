<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class IntersectionType extends AbstractResolver
{
    public function resolve(Type\IntersectionType $node): ResultContract
    {
        return RangerType::intersection(...array_map(
            fn ($type) => $this->from($type),
            $node->getTypes()
        ));
    }
}
