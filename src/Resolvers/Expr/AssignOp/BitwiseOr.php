<?php

namespace Laravel\Ranger\Resolvers\Expr\AssignOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class BitwiseOr extends AbstractResolver
{
    public function resolve(Node\Expr\AssignOp\BitwiseOr $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
