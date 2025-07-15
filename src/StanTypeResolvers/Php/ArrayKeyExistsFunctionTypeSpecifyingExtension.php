<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayKeyExistsFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\ArrayKeyExistsFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'ArrayKeyExistsFunctionTypeSpecifyingExtension not implemented yet');
    }
}
