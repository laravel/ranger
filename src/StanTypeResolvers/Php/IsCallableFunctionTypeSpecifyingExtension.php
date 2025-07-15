<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsCallableFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\IsCallableFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'IsCallableFunctionTypeSpecifyingExtension not implemented yet');
    }
}
