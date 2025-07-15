<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RecursionGuard extends AbstractResolver
{
    public function resolve(Type\RecursionGuard $node): ResultContract
    {
        dd($node, 'RecursionGuard not implemented yet');
    }
}
