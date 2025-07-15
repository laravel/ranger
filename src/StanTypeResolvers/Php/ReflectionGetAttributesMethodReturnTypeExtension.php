<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReflectionGetAttributesMethodReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReflectionGetAttributesMethodReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ReflectionGetAttributesMethodReturnTypeExtension not implemented yet');
    }
}
