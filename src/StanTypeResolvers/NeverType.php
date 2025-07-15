<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class NeverType extends AbstractResolver
{
    public function resolve(Type\NeverType $node): ResultContract
    {
        dd($node, 'NeverType not implemented yet');
    }
}
