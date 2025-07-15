<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypeProjectionHelper extends AbstractResolver
{
    public function resolve(Type\Generic\TypeProjectionHelper $node): ResultContract
    {
        dd($node, 'TypeProjectionHelper not implemented yet');
    }
}
