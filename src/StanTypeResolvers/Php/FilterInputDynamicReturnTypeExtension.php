<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class FilterInputDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\FilterInputDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'FilterInputDynamicReturnTypeExtension not implemented yet');
    }
}
