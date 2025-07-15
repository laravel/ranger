<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Minus extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\Minus $node): ResultContract
    {
        return RangerType::int();
    }
}
