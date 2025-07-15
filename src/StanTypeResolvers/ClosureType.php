<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClosureType extends AbstractResolver
{
    public function resolve(Type\ClosureType $node): ResultContract
    {
        dd($node, 'ClosureType not implemented yet');
    }
}
