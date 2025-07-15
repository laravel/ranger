<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayChangeKeyCaseFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayChangeKeyCaseFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ArrayChangeKeyCaseFunctionReturnTypeExtension not implemented yet');
    }
}
