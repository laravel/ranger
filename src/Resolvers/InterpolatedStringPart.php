<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class InterpolatedStringPart extends AbstractResolver
{
    public function resolve(Node\InterpolatedStringPart $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
