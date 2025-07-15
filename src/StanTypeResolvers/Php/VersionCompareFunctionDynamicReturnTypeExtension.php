<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class VersionCompareFunctionDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\VersionCompareFunctionDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'VersionCompareFunctionDynamicReturnTypeExtension not implemented yet');
    }
}
