<?php

namespace Laravel\Ranger\Resolvers\Stmt;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Continue_ extends AbstractResolver
{
    public function resolve(Node\Stmt\Continue_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
