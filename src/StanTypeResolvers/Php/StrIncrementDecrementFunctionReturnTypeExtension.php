<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrIncrementDecrementFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrIncrementDecrementFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrIncrementDecrementFunctionReturnTypeExtension not implemented yet');
    }
}
