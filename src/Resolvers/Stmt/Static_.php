<?php

namespace Laravel\Ranger\Resolvers\Stmt;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Static_ extends AbstractResolver
{
    public function resolve(Node\Stmt\Static_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
