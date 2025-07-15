<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFilterFunctionReturnTypeHelper extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFilterFunctionReturnTypeHelper $node): ResultContract
    {
        dd($node, 'ArrayFilterFunctionReturnTypeHelper not implemented yet');
    }
}
