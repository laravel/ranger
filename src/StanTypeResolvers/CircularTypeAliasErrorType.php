<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CircularTypeAliasErrorType extends AbstractResolver
{
    public function resolve(Type\CircularTypeAliasErrorType $node): ResultContract
    {
        dd($node, 'CircularTypeAliasErrorType not implemented yet');
    }
}
