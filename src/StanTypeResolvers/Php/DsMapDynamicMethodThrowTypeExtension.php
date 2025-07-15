<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DsMapDynamicMethodThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DsMapDynamicMethodThrowTypeExtension $node): ResultContract
    {
        dd($node, 'DsMapDynamicMethodThrowTypeExtension not implemented yet');
    }
}
