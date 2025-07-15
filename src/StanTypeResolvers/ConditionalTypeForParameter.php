<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConditionalTypeForParameter extends AbstractResolver
{
    public function resolve(Type\ConditionalTypeForParameter $node): ResultContract
    {
        dd($node, 'ConditionalTypeForParameter not implemented yet');
    }
}
