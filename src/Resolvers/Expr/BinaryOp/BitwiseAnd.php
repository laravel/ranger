<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class BitwiseAnd extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\BitwiseAnd $node): ResultContract
    {
        return RangerType::int();
    }
}
