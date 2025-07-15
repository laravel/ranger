<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AbsFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\AbsFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'AbsFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
