<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayKeyFirstDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayKeyFirstDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayKeyFirstDynamicReturnTypeExtension not implemented yet');
    }
}
