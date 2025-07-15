<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PregMatchParameterOutTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\PregMatchParameterOutTypeExtension $node): ResultContract
    {
        dd($node, 'PregMatchParameterOutTypeExtension not implemented yet');
    }
}
