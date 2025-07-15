<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArraySpliceFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArraySpliceFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArraySpliceFunctionReturnTypeExtension not implemented yet');
    }
}
