<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateIntervalConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateIntervalConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'DateIntervalConstructorThrowTypeExtension not implemented yet');
    }
}
