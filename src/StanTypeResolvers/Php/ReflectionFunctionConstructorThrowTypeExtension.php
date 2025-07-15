<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReflectionFunctionConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReflectionFunctionConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'ReflectionFunctionConstructorThrowTypeExtension not implemented yet');
    }
}
