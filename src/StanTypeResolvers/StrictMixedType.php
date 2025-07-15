<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrictMixedType extends AbstractResolver
{
    public function resolve(Type\StrictMixedType $node): ResultContract
    {
        dd($node, 'StrictMixedType not implemented yet');
    }
}
