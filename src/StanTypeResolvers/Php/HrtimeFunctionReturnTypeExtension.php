<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HrtimeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\HrtimeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'HrtimeFunctionReturnTypeExtension not implemented yet');
    }
}
