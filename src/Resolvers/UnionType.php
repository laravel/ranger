<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class UnionType extends AbstractResolver
{
    public function resolve(Node\UnionType $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
