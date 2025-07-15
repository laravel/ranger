<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrRepeatFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrRepeatFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrRepeatFunctionReturnTypeExtension not implemented yet');
    }
}
