<?php

namespace Laravel\Ranger\Resolvers\Expr\AssignOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Mul extends AbstractResolver
{
    public function resolve(Node\Expr\AssignOp\Mul $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
