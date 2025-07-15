<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StatDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StatDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StatDynamicReturnTypeExtension not implemented yet');
    }
}
