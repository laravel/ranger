<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeCreateDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeCreateDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeCreateDynamicReturnTypeExtension not implemented yet');
    }
}
