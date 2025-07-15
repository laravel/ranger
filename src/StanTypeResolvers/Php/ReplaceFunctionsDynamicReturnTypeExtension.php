<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ReplaceFunctionsDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ReplaceFunctionsDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ReplaceFunctionsDynamicReturnTypeExtension not implemented yet');
    }
}
