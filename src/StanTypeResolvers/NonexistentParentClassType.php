<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class NonexistentParentClassType extends AbstractResolver
{
    public function resolve(Type\NonexistentParentClassType $node): ResultContract
    {
        dd($node, 'NonexistentParentClassType not implemented yet');
    }
}
