<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GeneralizePrecision extends AbstractResolver
{
    public function resolve(Type\GeneralizePrecision $node): ResultContract
    {
        dd($node, 'GeneralizePrecision not implemented yet');
    }
}
