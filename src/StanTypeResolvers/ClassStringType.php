<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClassStringType extends AbstractResolver
{
    public function resolve(Type\ClassStringType $node): ResultContract
    {
        dd($node, 'ClassStringType not implemented yet');
    }
}
