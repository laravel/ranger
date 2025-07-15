<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Arg extends AbstractResolver
{
    public function resolve(Node\Arg $node): ResultContract
    {
        return $this->from($node->value);
    }
}
