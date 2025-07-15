<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AcceptsResult extends AbstractResolver
{
    public function resolve(Type\AcceptsResult $node): ResultContract
    {
        dd($node, 'AcceptsResult not implemented yet');
    }
}
