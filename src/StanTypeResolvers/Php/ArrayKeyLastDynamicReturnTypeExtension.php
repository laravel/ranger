<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayKeyLastDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayKeyLastDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayKeyLastDynamicReturnTypeExtension not implemented yet');
    }
}
