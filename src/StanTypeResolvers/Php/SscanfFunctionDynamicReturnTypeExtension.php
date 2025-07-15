<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SscanfFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\SscanfFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'SscanfFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
