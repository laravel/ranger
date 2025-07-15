<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GettimeofdayDynamicFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\GettimeofdayDynamicFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'GettimeofdayDynamicFunctionReturnTypeExtension not implemented yet');
    }
}
