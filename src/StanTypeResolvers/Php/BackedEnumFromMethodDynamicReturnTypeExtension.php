<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class BackedEnumFromMethodDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\BackedEnumFromMethodDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'BackedEnumFromMethodDynamicReturnTypeExtension not implemented yet');
    }
}
