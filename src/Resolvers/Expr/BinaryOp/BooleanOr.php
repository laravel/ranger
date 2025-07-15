<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class BooleanOr extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\BooleanOr $node): ResultContract
    {
        return RangerType::bool();
    }
}
