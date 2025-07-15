<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsIterableFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\IsIterableFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'IsIterableFunctionTypeSpecifyingExtension not implemented yet');
    }
}
