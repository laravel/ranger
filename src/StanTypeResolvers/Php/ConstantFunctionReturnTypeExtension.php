<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ConstantFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ConstantFunctionReturnTypeExtension not implemented yet');
    }
}
