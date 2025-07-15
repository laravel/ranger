<?php

namespace Laravel\Ranger\Resolvers\Expr\AssignOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Minus extends AbstractResolver
{
    public function resolve(Node\Expr\AssignOp\Minus $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
