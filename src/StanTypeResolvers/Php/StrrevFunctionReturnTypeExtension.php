<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrrevFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrrevFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrrevFunctionReturnTypeExtension not implemented yet');
    }
}
