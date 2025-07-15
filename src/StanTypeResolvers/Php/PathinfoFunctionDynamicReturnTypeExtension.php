<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PathinfoFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\PathinfoFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'PathinfoFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
