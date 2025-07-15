<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RandomIntFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\RandomIntFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'RandomIntFunctionReturnTypeExtension not implemented yet');
    }
}
