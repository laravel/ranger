<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsAFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\IsAFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'IsAFunctionTypeSpecifyingExtension not implemented yet');
    }
}
