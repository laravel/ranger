<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class BenevolentUnionType extends AbstractResolver
{
    public function resolve(Type\BenevolentUnionType $node): ResultContract
    {
        return RangerType::union(...array_map(
            fn ($type) => $this->from($type),
            $node->getTypes()
        ));
    }
}
