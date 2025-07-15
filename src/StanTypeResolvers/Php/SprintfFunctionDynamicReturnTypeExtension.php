<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SprintfFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\SprintfFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'SprintfFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
