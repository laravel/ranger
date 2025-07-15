<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class NullableType extends AbstractResolver
{
    public function resolve(Node\NullableType $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
