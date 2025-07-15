<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayPopFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayPopFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayPopFunctionReturnTypeExtension not implemented yet');
    }
}
