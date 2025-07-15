<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClosureFromCallableDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ClosureFromCallableDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ClosureFromCallableDynamicReturnTypeExtension not implemented yet');
    }
}
