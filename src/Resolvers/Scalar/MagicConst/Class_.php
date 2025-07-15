<?php

namespace Laravel\Ranger\Resolvers\Scalar\MagicConst;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Class_ extends AbstractResolver
{
    public function resolve(Node\Scalar\MagicConst\Class_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
