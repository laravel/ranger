<?php

namespace Laravel\Ranger\Resolvers\Scalar\MagicConst;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Dir extends AbstractResolver
{
    public function resolve(Node\Scalar\MagicConst\Dir $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
