<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ThisType extends AbstractResolver
{
    public function resolve(Type\ThisType $node): ResultContract
    {
        dd($node, 'ThisType not implemented yet');
    }
}
