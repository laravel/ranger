<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Stmt extends AbstractResolver
{
    public function resolve(Node\Stmt $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
