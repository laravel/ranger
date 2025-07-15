<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class BooleanNot extends AbstractResolver
{
    public function resolve(Node\Expr\BooleanNot $node): ResultContract
    {
        return RangerType::bool();
    }
}
