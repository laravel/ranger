<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GetDebugTypeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\GetDebugTypeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'GetDebugTypeFunctionReturnTypeExtension not implemented yet');
    }
}
