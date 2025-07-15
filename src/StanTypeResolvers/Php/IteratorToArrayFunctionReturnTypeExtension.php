<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IteratorToArrayFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\IteratorToArrayFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'IteratorToArrayFunctionReturnTypeExtension not implemented yet');
    }
}
