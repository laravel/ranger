<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Resolvers\Concerns\ResolvesProperties;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class PropertyFetch extends AbstractResolver
{
    use ResolvesProperties;

    public function resolve(Node\Expr\PropertyFetch $node): ResultContract
    {
        return $this->resolveProperty($node);
    }
}
