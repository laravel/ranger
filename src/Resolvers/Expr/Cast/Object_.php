<?php

namespace Laravel\Ranger\Resolvers\Expr\Cast;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Object_ extends AbstractResolver
{
    public function resolve(Node\Expr\Cast\Object_ $node): ResultContract
    {
        return $this->from($node->expr);
    }
}
