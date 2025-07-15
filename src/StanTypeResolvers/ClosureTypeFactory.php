<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClosureTypeFactory extends AbstractResolver
{
    public function resolve(Type\ClosureTypeFactory $node): ResultContract
    {
        dd($node, 'ClosureTypeFactory not implemented yet');
    }
}
