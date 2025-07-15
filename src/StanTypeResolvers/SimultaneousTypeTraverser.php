<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class SimultaneousTypeTraverser extends AbstractResolver
{
    public function resolve(Type\SimultaneousTypeTraverser $node): ResultContract
    {
        dd($node, 'SimultaneousTypeTraverser not implemented yet');
    }
}
