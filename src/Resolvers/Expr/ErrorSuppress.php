<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class ErrorSuppress extends AbstractResolver
{
    public function resolve(Node\Expr\ErrorSuppress $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
