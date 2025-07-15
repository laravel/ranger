<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DefineConstantTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\DefineConstantTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'DefineConstantTypeSpecifyingExtension not implemented yet');
    }
}
