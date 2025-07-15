<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class OperatorTypeSpecifyingExtensionRegistry extends AbstractResolver
{
    public function resolve(Type\OperatorTypeSpecifyingExtensionRegistry $node): ResultContract
    {
        dd($node, 'OperatorTypeSpecifyingExtensionRegistry not implemented yet');
    }
}
