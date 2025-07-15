<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayNextDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayNextDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayNextDynamicReturnTypeExtension not implemented yet');
    }
}
