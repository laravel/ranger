<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayKeysFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayKeysFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayKeysFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
