<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayMapFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayMapFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayMapFunctionReturnTypeExtension not implemented yet');
    }
}
