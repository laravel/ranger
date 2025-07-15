<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Include_ extends AbstractResolver
{
    public function resolve(Node\Expr\Include_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
