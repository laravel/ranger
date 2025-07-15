<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MinMaxFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\MinMaxFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'MinMaxFunctionReturnTypeExtension not implemented yet');
    }
}
