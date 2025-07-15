<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class NonAcceptingNeverType extends AbstractResolver
{
    public function resolve(Type\NonAcceptingNeverType $node): ResultContract
    {
        dd($node, 'NonAcceptingNeverType not implemented yet');
    }
}
