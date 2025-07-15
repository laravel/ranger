<?php

namespace Laravel\Ranger\StanTypeResolvers\PHPStan;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClassNameUsageLocationCreateIdentifierDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\PHPStan\ClassNameUsageLocationCreateIdentifierDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ClassNameUsageLocationCreateIdentifierDynamicReturnTypeExtension not implemented yet');
    }
}
