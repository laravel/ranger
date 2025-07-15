<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DefinedConstantTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\DefinedConstantTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'DefinedConstantTypeSpecifyingExtension not implemented yet');
    }
}
