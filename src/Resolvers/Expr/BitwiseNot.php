<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class BitwiseNot extends AbstractResolver
{
    public function resolve(Node\Expr\BitwiseNot $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
