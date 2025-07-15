<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CallableType extends AbstractResolver
{
    public function resolve(Type\CallableType $node): ResultContract
    {
        dd($node, 'CallableType not implemented yet');
    }
}
