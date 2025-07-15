<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFlipFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFlipFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayFlipFunctionReturnTypeExtension not implemented yet');
    }
}
