<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateFormatMethodReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateFormatMethodReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateFormatMethodReturnTypeExtension not implemented yet');
    }
}
