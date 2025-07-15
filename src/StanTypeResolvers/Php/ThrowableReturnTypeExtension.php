<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ThrowableReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ThrowableReturnTypeExtension $node): ResultContract
    {
        dd($node, 'ThrowableReturnTypeExtension not implemented yet');
    }
}
