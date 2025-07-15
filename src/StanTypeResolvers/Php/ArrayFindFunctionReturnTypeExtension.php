<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFindFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFindFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayFindFunctionReturnTypeExtension not implemented yet');
    }
}
