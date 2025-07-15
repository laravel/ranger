<?php

namespace Laravel\Ranger\Resolvers\Stmt;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class GroupUse extends AbstractResolver
{
    public function resolve(Node\Stmt\GroupUse $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
