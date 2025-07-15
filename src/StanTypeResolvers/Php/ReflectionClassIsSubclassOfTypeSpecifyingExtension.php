<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReflectionClassIsSubclassOfTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReflectionClassIsSubclassOfTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'ReflectionClassIsSubclassOfTypeSpecifyingExtension not implemented yet');
    }
}
