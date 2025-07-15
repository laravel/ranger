<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DatePeriodConstructorReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DatePeriodConstructorReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DatePeriodConstructorReturnTypeExtension not implemented yet');
    }
}
