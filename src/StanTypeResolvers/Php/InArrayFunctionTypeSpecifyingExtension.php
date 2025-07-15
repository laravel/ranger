<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class InArrayFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\InArrayFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'InArrayFunctionTypeSpecifyingExtension not implemented yet');
    }
}
