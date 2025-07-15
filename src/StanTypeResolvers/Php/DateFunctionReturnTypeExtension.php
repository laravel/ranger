<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateFunctionReturnTypeExtension not implemented yet');
    }
}
