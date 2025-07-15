<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeTraverser extends AbstractResolver
{
    public function resolve(Type\TypeTraverser $node): ResultContract
    {
        dd($node, 'TypeTraverser not implemented yet');
    }
}
