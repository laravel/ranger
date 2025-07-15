<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CurlGetinfoFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\CurlGetinfoFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'CurlGetinfoFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
