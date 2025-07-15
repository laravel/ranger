<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class VoidType extends AbstractResolver
{
    public function resolve(Type\VoidType $node): ResultContract
    {
        dd($node, 'VoidType not implemented yet');
    }
}
