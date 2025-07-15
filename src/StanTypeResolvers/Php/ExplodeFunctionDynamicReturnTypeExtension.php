<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ExplodeFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ExplodeFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ExplodeFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
