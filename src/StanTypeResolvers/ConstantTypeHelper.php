<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantTypeHelper extends AbstractResolver
{
    public function resolve(Type\ConstantTypeHelper $node): ResultContract
    {
        dd($node, 'ConstantTypeHelper not implemented yet');
    }
}
