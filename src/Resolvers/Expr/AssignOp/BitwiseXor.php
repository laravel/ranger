<?php

namespace Laravel\Ranger\Resolvers\Expr\AssignOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class BitwiseXor extends AbstractResolver
{
    public function resolve(Node\Expr\AssignOp\BitwiseXor $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
