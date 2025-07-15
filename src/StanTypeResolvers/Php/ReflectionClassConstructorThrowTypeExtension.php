<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReflectionClassConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReflectionClassConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'ReflectionClassConstructorThrowTypeExtension not implemented yet');
    }
}
