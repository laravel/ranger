<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CountCharsFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\CountCharsFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'CountCharsFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
