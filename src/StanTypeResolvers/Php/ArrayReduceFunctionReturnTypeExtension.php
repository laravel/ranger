<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayReduceFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayReduceFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayReduceFunctionReturnTypeExtension not implemented yet');
    }
}
