<?php

namespace Laravel\Ranger\Resolvers\Stmt\TraitUseAdaptation;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Alias extends AbstractResolver
{
    public function resolve(Node\Stmt\TraitUseAdaptation\Alias $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
