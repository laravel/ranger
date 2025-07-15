<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayRandFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayRandFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayRandFunctionReturnTypeExtension not implemented yet');
    }
}
