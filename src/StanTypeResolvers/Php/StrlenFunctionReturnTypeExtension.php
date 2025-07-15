<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrlenFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrlenFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrlenFunctionReturnTypeExtension not implemented yet');
    }
}
