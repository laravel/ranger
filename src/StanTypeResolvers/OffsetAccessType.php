<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class OffsetAccessType extends AbstractResolver
{
    public function resolve(Type\OffsetAccessType $node): ResultContract
    {
        dd($node, 'OffsetAccessType not implemented yet');
    }
}
