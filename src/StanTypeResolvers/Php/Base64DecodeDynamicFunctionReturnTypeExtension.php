<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class Base64DecodeDynamicFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\Base64DecodeDynamicFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'Base64DecodeDynamicFunctionReturnTypeExtension not implemented yet');
    }
}
