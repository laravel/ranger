<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayPointerFunctionsDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayPointerFunctionsDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayPointerFunctionsDynamicReturnTypeExtension not implemented yet');
    }
}
