<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CallableTypeHelper extends AbstractResolver
{
    public function resolve(Type\CallableTypeHelper $node): ResultContract
    {
        dd($node, 'CallableTypeHelper not implemented yet');
    }
}
