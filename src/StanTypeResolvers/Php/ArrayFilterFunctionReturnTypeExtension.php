<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFilterFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFilterFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayFilterFunctionReturnTypeExtension not implemented yet');
    }
}
