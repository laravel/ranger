<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReflectionPropertyConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReflectionPropertyConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'ReflectionPropertyConstructorThrowTypeExtension not implemented yet');
    }
}
