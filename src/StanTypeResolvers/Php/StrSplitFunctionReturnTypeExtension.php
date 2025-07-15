<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrSplitFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrSplitFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrSplitFunctionReturnTypeExtension not implemented yet');
    }
}
