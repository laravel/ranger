<?php

namespace Laravel\Ranger\Resolvers\Scalar\MagicConst;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Line extends AbstractResolver
{
    public function resolve(Node\Scalar\MagicConst\Line $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
