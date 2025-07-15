<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeDynamicReturnTypeExtension not implemented yet');
    }
}
