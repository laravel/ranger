<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class ArrowFunction extends AbstractResolver
{
    public function resolve(Node\Expr\ArrowFunction $node): ResultContract
    {
        return $this->from($node->expr);
    }
}
