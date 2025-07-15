<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GenericClassStringType extends AbstractResolver
{
    public function resolve(Type\Generic\GenericClassStringType $node): ResultContract
    {
        dd($node, 'GenericClassStringType not implemented yet');
    }
}
