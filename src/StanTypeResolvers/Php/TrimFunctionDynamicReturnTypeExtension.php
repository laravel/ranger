<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TrimFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\TrimFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'TrimFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
