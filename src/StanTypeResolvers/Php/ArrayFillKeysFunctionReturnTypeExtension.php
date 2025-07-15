<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFillKeysFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFillKeysFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayFillKeysFunctionReturnTypeExtension not implemented yet');
    }
}
