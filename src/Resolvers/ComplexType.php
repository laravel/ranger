<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class ComplexType extends AbstractResolver
{
    public function resolve(Node\ComplexType $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
