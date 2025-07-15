<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArraySearchFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArraySearchFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'ArraySearchFunctionTypeSpecifyingExtension not implemented yet');
    }
}
