<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class FloatType extends AbstractResolver
{
    public function resolve(Type\FloatType $node): ResultContract
    {
        dd($node, 'FloatType not implemented yet');
    }
}
