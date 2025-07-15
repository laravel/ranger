<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayFindKeyFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayFindKeyFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayFindKeyFunctionReturnTypeExtension not implemented yet');
    }
}
