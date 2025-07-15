<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ExpressionTypeResolverExtensionRegistry extends AbstractResolver
{
    public function resolve(Type\ExpressionTypeResolverExtensionRegistry $node): ResultContract
    {
        dd($node, 'ExpressionTypeResolverExtensionRegistry not implemented yet');
    }
}
