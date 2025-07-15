<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class NewObjectType extends AbstractResolver
{
    public function resolve(Type\NewObjectType $node): ResultContract
    {
        dd($node, 'NewObjectType not implemented yet');
    }
}
