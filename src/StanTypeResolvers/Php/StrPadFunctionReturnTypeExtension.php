<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrPadFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrPadFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrPadFunctionReturnTypeExtension not implemented yet');
    }
}
