<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class PostInc extends AbstractResolver
{
    public function resolve(Node\Expr\PostInc $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
