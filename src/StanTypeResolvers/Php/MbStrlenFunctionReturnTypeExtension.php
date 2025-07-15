<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MbStrlenFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\MbStrlenFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'MbStrlenFunctionReturnTypeExtension not implemented yet');
    }
}
