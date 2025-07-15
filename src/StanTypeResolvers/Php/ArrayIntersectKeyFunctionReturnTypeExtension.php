<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayIntersectKeyFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayIntersectKeyFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayIntersectKeyFunctionReturnTypeExtension not implemented yet');
    }
}
