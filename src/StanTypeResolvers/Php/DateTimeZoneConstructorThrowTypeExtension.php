<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeZoneConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeZoneConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeZoneConstructorThrowTypeExtension not implemented yet');
    }
}
