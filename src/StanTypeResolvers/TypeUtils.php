<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeUtils extends AbstractResolver
{
    public function resolve(Type\TypeUtils $node): ResultContract
    {
        dd($node, 'TypeUtils not implemented yet');
    }
}
