<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DateFunctionReturnTypeHelper extends AbstractResolver
{
    public function resolve(Type\Php\DateFunctionReturnTypeHelper $node): ResultContract
    {
        dd($node, 'DateFunctionReturnTypeHelper not implemented yet');
    }
}
