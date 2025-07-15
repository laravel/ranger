<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AssertFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\AssertFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'AssertFunctionTypeSpecifyingExtension not implemented yet');
    }
}
