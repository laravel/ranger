<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayCurrentDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayCurrentDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayCurrentDynamicReturnTypeExtension not implemented yet');
    }
}
