<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class MatchArm extends AbstractResolver
{
    public function resolve(Node\MatchArm $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
