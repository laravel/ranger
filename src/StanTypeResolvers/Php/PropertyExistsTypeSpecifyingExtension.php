<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PropertyExistsTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\PropertyExistsTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'PropertyExistsTypeSpecifyingExtension not implemented yet');
    }
}
