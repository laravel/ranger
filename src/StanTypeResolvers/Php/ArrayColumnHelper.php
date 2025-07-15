<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ArrayColumnHelper extends AbstractResolver
{
    public function resolve(Type\Php\ArrayColumnHelper $node): ResultContract
    {
        dd($node, 'ArrayColumnHelper not implemented yet');
    }
}
