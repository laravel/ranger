<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class NumberFormatFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\NumberFormatFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'NumberFormatFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
