<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ValueOfType extends AbstractResolver
{
    public function resolve(Type\ValueOfType $node): ResultContract
    {
        dd($node, 'ValueOfType not implemented yet');
    }
}
