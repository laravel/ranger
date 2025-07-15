<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SimpleXMLElementClassPropertyReflectionExtension extends AbstractResolver
{
    public function resolve(Type\Php\SimpleXMLElementClassPropertyReflectionExtension $node): ResultContract
    {
        dd($node, 'SimpleXMLElementClassPropertyReflectionExtension not implemented yet');
    }
}
