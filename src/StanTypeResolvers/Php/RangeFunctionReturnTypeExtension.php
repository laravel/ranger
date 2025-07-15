<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RangeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\RangeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'RangeFunctionReturnTypeExtension not implemented yet');
    }
}
