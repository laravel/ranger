<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DsMapDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DsMapDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DsMapDynamicReturnTypeExtension not implemented yet');
    }
}
