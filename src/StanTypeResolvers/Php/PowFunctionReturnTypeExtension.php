<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PowFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\PowFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'PowFunctionReturnTypeExtension not implemented yet');
    }
}
