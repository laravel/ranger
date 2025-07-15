<?php

namespace Laravel\Ranger\Resolvers\Scalar;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class MagicConst extends AbstractResolver
{
    public function resolve(Node\Scalar\MagicConst $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
