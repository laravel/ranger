<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TypehintHelper extends AbstractResolver
{
    public function resolve(Type\TypehintHelper $node): ResultContract
    {
        dd($node, 'TypehintHelper not implemented yet');
    }
}
