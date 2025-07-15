<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class JsonThrowOnErrorDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\JsonThrowOnErrorDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'JsonThrowOnErrorDynamicReturnTypeExtension not implemented yet');
    }
}
