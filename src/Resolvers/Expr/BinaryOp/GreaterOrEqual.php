<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class GreaterOrEqual extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\GreaterOrEqual $node): ResultContract
    {
        return RangerType::bool();
    }
}
