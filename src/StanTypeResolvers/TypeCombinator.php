<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeCombinator extends AbstractResolver
{
    public function resolve(Type\TypeCombinator $node): ResultContract
    {
        dd($node, 'TypeCombinator not implemented yet');
    }
}
