<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeSpecifyingFunctionsDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\TypeSpecifyingFunctionsDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'TypeSpecifyingFunctionsDynamicReturnTypeExtension not implemented yet');
    }
}
