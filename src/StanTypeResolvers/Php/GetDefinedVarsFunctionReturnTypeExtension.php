<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GetDefinedVarsFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\GetDefinedVarsFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'GetDefinedVarsFunctionReturnTypeExtension not implemented yet');
    }
}
