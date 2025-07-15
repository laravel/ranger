<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class StaticPropertyFetch extends AbstractResolver
{
    public function resolve(Node\Expr\StaticPropertyFetch $node): ResultContract
    {
        return $this->from($node->class);
    }
}
