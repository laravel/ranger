<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeAlias extends AbstractResolver
{
    public function resolve(Type\TypeAlias $node): ResultContract
    {
        dd($node, 'TypeAlias not implemented yet');
    }
}
