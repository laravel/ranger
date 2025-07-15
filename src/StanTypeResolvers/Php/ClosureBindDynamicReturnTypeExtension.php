<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClosureBindDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ClosureBindDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ClosureBindDynamicReturnTypeExtension not implemented yet');
    }
}
