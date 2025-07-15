<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayChunkFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayChunkFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayChunkFunctionReturnTypeExtension not implemented yet');
    }
}
