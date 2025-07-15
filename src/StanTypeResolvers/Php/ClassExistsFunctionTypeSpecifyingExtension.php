<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClassExistsFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\ClassExistsFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'ClassExistsFunctionTypeSpecifyingExtension not implemented yet');
    }
}
