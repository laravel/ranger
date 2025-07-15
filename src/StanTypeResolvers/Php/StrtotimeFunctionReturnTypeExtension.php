<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrtotimeFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrtotimeFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrtotimeFunctionReturnTypeExtension not implemented yet');
    }
}
