<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GenericStaticType extends AbstractResolver
{
    public function resolve(Type\Generic\GenericStaticType $node): ResultContract
    {
        dd($node, 'GenericStaticType not implemented yet');
    }
}
