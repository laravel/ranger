<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateTimeSubMethodThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\DateTimeSubMethodThrowTypeExtension $node): ResultContract
    {
        dd($node, 'DateTimeSubMethodThrowTypeExtension not implemented yet');
    }
}
