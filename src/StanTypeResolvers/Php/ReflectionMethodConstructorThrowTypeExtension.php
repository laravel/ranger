<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReflectionMethodConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReflectionMethodConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'ReflectionMethodConstructorThrowTypeExtension not implemented yet');
    }
}
