<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SetTypeFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\SetTypeFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'SetTypeFunctionTypeSpecifyingExtension not implemented yet');
    }
}
