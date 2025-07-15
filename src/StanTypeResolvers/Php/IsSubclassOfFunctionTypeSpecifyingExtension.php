<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsSubclassOfFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\IsSubclassOfFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'IsSubclassOfFunctionTypeSpecifyingExtension not implemented yet');
    }
}
