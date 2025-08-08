<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Resolvers\Concerns\ResolvesMethods;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class MethodCall extends AbstractResolver
{
    use ResolvesMethods;

    public function resolve(Node\Expr\MethodCall $node): ResultContract
    {
        return $this->resolveMethod($node);
    }
}
