<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class FilterVarDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\FilterVarDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'FilterVarDynamicReturnTypeExtension not implemented yet');
    }
}
