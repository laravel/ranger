<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArraySliceFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArraySliceFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArraySliceFunctionReturnTypeExtension not implemented yet');
    }
}
