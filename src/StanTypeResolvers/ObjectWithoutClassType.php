<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ObjectWithoutClassType extends AbstractResolver
{
    public function resolve(Type\ObjectWithoutClassType $node): ResultContract
    {
        dd($node, 'ObjectWithoutClassType not implemented yet');
    }
}
