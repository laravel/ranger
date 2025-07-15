<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArgumentBasedFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArgumentBasedFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArgumentBasedFunctionReturnTypeExtension not implemented yet');
    }
}
