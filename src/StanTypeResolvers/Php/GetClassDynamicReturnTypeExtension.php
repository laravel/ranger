<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GetClassDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\GetClassDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'GetClassDynamicReturnTypeExtension not implemented yet');
    }
}
