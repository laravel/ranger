<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Error extends AbstractResolver
{
    public function resolve(Node\Expr\Error $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
