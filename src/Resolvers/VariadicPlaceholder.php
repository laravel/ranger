<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class VariadicPlaceholder extends AbstractResolver
{
    public function resolve(Node\VariadicPlaceholder $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
