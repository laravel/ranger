<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class ClosureUse extends AbstractResolver
{
    public function resolve(Node\ClosureUse $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
