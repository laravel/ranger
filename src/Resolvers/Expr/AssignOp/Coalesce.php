<?php

namespace Laravel\Ranger\Resolvers\Expr\AssignOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Coalesce extends AbstractResolver
{
    public function resolve(Node\Expr\AssignOp\Coalesce $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
