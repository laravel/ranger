<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Equal extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\Equal $node): ResultContract
    {
        return RangerType::bool();
    }
}
