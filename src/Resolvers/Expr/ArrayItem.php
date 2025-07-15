<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class ArrayItem extends AbstractResolver
{
    public function resolve(Node\Expr\ArrayItem $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
