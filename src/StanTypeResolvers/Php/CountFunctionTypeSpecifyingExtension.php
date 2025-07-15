<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CountFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\CountFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'CountFunctionTypeSpecifyingExtension not implemented yet');
    }
}
