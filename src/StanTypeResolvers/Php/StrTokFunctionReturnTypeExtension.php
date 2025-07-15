<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrTokFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrTokFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrTokFunctionReturnTypeExtension not implemented yet');
    }
}
