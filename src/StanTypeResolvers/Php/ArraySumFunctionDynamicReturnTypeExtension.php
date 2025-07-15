<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArraySumFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArraySumFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArraySumFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
