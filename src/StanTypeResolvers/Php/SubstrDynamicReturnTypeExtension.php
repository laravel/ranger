<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SubstrDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\SubstrDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'SubstrDynamicReturnTypeExtension not implemented yet');
    }
}
