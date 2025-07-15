<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CompactFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\CompactFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'CompactFunctionReturnTypeExtension not implemented yet');
    }
}
