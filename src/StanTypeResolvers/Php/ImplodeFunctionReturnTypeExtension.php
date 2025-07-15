<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ImplodeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ImplodeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ImplodeFunctionReturnTypeExtension not implemented yet');
    }
}
