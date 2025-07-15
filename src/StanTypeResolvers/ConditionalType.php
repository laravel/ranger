<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConditionalType extends AbstractResolver
{
    public function resolve(Type\ConditionalType $node): ResultContract
    {
        dd($node, 'ConditionalType not implemented yet');
    }
}
