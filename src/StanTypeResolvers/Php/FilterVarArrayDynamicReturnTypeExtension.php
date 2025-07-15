<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class FilterVarArrayDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\FilterVarArrayDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'FilterVarArrayDynamicReturnTypeExtension not implemented yet');
    }
}
