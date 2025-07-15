<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrvalFamilyFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrvalFamilyFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrvalFamilyFunctionReturnTypeExtension not implemented yet');
    }
}
