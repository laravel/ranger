<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ClosureBindToDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ClosureBindToDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ClosureBindToDynamicReturnTypeExtension not implemented yet');
    }
}
