<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayReverseFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayReverseFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayReverseFunctionReturnTypeExtension not implemented yet');
    }
}
