<?php

namespace Laravel\Ranger\Resolvers\Stmt\TraitUseAdaptation;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Precedence extends AbstractResolver
{
    public function resolve(Node\Stmt\TraitUseAdaptation\Precedence $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
