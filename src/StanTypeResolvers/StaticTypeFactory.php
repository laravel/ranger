<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StaticTypeFactory extends AbstractResolver
{
    public function resolve(Type\StaticTypeFactory $node): ResultContract
    {
        dd($node, 'StaticTypeFactory not implemented yet');
    }
}
