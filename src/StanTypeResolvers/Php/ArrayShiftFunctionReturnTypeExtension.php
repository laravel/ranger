<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayShiftFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayShiftFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayShiftFunctionReturnTypeExtension not implemented yet');
    }
}
