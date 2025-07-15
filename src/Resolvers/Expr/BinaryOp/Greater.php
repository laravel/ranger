<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Greater extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\Greater $node): ResultContract
    {
        return RangerType::bool();
    }
}
