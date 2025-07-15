<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFillFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFillFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayFillFunctionReturnTypeExtension not implemented yet');
    }
}
