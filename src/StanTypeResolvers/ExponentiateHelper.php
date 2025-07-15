<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ExponentiateHelper extends AbstractResolver
{
    public function resolve(Type\ExponentiateHelper $node): ResultContract
    {
        dd($node, 'ExponentiateHelper not implemented yet');
    }
}
