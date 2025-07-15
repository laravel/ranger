<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class BinaryOp extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
