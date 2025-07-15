<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Isset_ extends AbstractResolver
{
    public function resolve(Node\Expr\Isset_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
