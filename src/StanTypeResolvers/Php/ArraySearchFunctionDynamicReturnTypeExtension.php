<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArraySearchFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArraySearchFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArraySearchFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
