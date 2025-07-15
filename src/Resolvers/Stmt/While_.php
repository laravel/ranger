<?php

namespace Laravel\Ranger\Resolvers\Stmt;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class While_ extends AbstractResolver
{
    public function resolve(Node\Stmt\While_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
