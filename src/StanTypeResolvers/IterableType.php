<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IterableType extends AbstractResolver
{
    public function resolve(Type\IterableType $node): ResultContract
    {
        dd($node, 'IterableType not implemented yet');
    }
}
