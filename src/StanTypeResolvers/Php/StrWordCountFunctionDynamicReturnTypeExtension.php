<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrWordCountFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrWordCountFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrWordCountFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
