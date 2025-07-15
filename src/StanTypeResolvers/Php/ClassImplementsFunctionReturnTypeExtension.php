<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClassImplementsFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ClassImplementsFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ClassImplementsFunctionReturnTypeExtension not implemented yet');
    }
}
