<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateIntervalDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateIntervalDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateIntervalDynamicReturnTypeExtension not implemented yet');
    }
}
