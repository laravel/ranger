<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DynamicReturnTypeExtensionRegistry extends AbstractResolver
{
    public function resolve(Type\DynamicReturnTypeExtensionRegistry $node): ResultContract
    {
        dd($node, 'DynamicReturnTypeExtensionRegistry not implemented yet');
    }
}
