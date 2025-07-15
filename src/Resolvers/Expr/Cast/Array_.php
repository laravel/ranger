<?php

namespace Laravel\Ranger\Resolvers\Expr\Cast;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Array_ extends AbstractResolver
{
    public function resolve(Node\Expr\Cast\Array_ $node): ResultContract
    {
        return $this->from($node->expr);
    }
}
