<?php

namespace Laravel\Ranger\Resolvers\Stmt;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Goto_ extends AbstractResolver
{
    public function resolve(Node\Stmt\Goto_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
