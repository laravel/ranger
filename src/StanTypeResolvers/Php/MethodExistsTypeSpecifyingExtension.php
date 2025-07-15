<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MethodExistsTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\MethodExistsTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'MethodExistsTypeSpecifyingExtension not implemented yet');
    }
}
