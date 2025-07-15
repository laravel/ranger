<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayMergeFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayMergeFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayMergeFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
