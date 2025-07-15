<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayValuesFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayValuesFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayValuesFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
