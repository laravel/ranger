<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class VarLikeIdentifier extends AbstractResolver
{
    public function resolve(Node\VarLikeIdentifier $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
