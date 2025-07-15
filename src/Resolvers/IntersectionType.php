<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class IntersectionType extends AbstractResolver
{
    public function resolve(Node\IntersectionType $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
