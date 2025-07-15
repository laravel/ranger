<?php

namespace Laravel\Ranger\Resolvers\Name;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Relative extends AbstractResolver
{
    public function resolve(Node\Name\Relative $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
