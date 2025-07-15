<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class DeclareItem extends AbstractResolver
{
    public function resolve(Node\DeclareItem $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
