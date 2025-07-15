<?php

namespace Laravel\Ranger\Resolvers\Expr\AssignOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Mod extends AbstractResolver
{
    public function resolve(Node\Expr\AssignOp\Mod $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
