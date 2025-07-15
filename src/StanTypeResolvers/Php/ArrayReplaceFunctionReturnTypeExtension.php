<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayReplaceFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayReplaceFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayReplaceFunctionReturnTypeExtension not implemented yet');
    }
}
