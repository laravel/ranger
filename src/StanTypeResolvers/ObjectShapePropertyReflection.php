<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ObjectShapePropertyReflection extends AbstractResolver
{
    public function resolve(Type\ObjectShapePropertyReflection $node): ResultContract
    {
        dd($node, 'ObjectShapePropertyReflection not implemented yet');
    }
}
