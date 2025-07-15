<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeModifyMethodThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeModifyMethodThrowTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeModifyMethodThrowTypeExtension not implemented yet');
    }
}
