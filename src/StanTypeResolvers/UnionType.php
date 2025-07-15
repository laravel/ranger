<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class UnionType extends AbstractResolver
{
    public function resolve(Type\UnionType $node): ResultContract
    {
        return RangerType::union(
            ...collect($node->getTypes())
                ->map(fn ($type) => $this->from($type))
                ->unique(),
        );
    }
}
