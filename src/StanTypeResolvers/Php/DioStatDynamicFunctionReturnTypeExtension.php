<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DioStatDynamicFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DioStatDynamicFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DioStatDynamicFunctionReturnTypeExtension not implemented yet');
    }
}
