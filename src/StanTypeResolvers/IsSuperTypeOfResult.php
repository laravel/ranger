<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsSuperTypeOfResult extends AbstractResolver
{
    public function resolve(Type\IsSuperTypeOfResult $node): ResultContract
    {
        dd($node, 'IsSuperTypeOfResult not implemented yet');
    }
}
