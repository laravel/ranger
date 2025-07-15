<?php

namespace Laravel\Ranger\Resolvers\Scalar;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Encapsed extends AbstractResolver
{
    public function resolve(Node\Scalar\Encapsed $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
