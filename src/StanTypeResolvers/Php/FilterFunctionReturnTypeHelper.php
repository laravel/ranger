<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class FilterFunctionReturnTypeHelper extends AbstractResolver
{
    public function resolve(Type\Php\FilterFunctionReturnTypeHelper $node): ResultContract
    {
        dd($node, 'FilterFunctionReturnTypeHelper not implemented yet');
    }
}
