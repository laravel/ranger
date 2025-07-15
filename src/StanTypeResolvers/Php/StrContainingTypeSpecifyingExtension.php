<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrContainingTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrContainingTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'StrContainingTypeSpecifyingExtension not implemented yet');
    }
}
