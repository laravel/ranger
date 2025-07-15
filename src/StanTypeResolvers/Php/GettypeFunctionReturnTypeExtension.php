<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GettypeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\GettypeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'GettypeFunctionReturnTypeExtension not implemented yet');
    }
}
