<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ParseUrlFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ParseUrlFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ParseUrlFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
