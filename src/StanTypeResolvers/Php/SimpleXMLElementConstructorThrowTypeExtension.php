<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SimpleXMLElementConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\SimpleXMLElementConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'SimpleXMLElementConstructorThrowTypeExtension not implemented yet');
    }
}
