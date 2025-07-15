<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SimpleXMLElementAsXMLMethodReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\SimpleXMLElementAsXMLMethodReturnTypeExtension $node): ResultContract
    {
        dd($node, 'SimpleXMLElementAsXMLMethodReturnTypeExtension not implemented yet');
    }
}
