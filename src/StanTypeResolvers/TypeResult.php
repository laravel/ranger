<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeResult extends AbstractResolver
{
    public function resolve(Type\TypeResult $node): ResultContract
    {
        dd($node, 'TypeResult not implemented yet');
    }
}
