<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateFormatFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateFormatFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateFormatFunctionReturnTypeExtension not implemented yet');
    }
}
