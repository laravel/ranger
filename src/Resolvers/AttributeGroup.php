<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class AttributeGroup extends AbstractResolver
{
    public function resolve(Node\AttributeGroup $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
