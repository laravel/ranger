<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeModifyReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeModifyReturnTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeModifyReturnTypeExtension not implemented yet');
    }
}
