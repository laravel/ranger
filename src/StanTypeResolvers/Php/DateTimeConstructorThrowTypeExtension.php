<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeConstructorThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeConstructorThrowTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeConstructorThrowTypeExtension not implemented yet');
    }
}
