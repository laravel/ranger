<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayColumnFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayColumnFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayColumnFunctionReturnTypeExtension not implemented yet');
    }
}
