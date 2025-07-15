<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsArrayFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\IsArrayFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'IsArrayFunctionTypeSpecifyingExtension not implemented yet');
    }
}
