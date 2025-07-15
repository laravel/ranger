<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RoundFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\RoundFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'RoundFunctionReturnTypeExtension not implemented yet');
    }
}
