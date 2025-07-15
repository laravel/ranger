<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PregMatchTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\PregMatchTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'PregMatchTypeSpecifyingExtension not implemented yet');
    }
}
