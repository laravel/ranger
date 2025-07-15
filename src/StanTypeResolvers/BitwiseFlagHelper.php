<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class BitwiseFlagHelper extends AbstractResolver
{
    public function resolve(Type\BitwiseFlagHelper $node): ResultContract
    {
        dd($node, 'BitwiseFlagHelper not implemented yet');
    }
}
