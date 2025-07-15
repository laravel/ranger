<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StringAlwaysAcceptingObjectWithToStringType extends AbstractResolver
{
    public function resolve(Type\StringAlwaysAcceptingObjectWithToStringType $node): ResultContract
    {
        dd($node, 'StringAlwaysAcceptingObjectWithToStringType not implemented yet');
    }
}
