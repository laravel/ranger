<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class UnionTypeHelper extends AbstractResolver
{
    public function resolve(Type\UnionTypeHelper $node): ResultContract
    {
        dd($node, 'UnionTypeHelper not implemented yet');
    }
}
