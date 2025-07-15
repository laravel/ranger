<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayCombineFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayCombineFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayCombineFunctionReturnTypeExtension not implemented yet');
    }
}
