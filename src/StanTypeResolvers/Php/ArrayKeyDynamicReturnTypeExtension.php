<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayKeyDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayKeyDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayKeyDynamicReturnTypeExtension not implemented yet');
    }
}
