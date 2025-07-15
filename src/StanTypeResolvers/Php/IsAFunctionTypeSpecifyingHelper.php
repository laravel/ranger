<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IsAFunctionTypeSpecifyingHelper extends AbstractResolver
{
    public function resolve(Type\Php\IsAFunctionTypeSpecifyingHelper $node): ResultContract
    {
        dd($node, 'IsAFunctionTypeSpecifyingHelper not implemented yet');
    }
}
