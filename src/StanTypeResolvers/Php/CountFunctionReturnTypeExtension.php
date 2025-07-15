<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CountFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\CountFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'CountFunctionReturnTypeExtension not implemented yet');
    }
}
