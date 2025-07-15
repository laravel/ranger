<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PregFilterFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\PregFilterFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'PregFilterFunctionReturnTypeExtension not implemented yet');
    }
}
