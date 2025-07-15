<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StaticType extends AbstractResolver
{
    public function resolve(Type\StaticType $node): ResultContract
    {
        dd($node, 'StaticType not implemented yet');
    }
}
