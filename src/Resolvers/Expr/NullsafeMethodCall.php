<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Resolvers\Concerns\ResolvesMethods;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class NullsafeMethodCall extends AbstractResolver
{
    use ResolvesMethods;

    public function resolve(Node\Expr\NullsafeMethodCall $node): ResultContract
    {
        $resolved = $this->resolveMethod($node);

        $resolved->nullable();

        return $resolved;
    }
}
