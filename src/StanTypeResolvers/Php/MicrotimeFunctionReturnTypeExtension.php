<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MicrotimeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\MicrotimeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'MicrotimeFunctionReturnTypeExtension not implemented yet');
    }
}
