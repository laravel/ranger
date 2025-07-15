<?php

namespace Laravel\Ranger\Resolvers\Expr\BinaryOp;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Coalesce extends AbstractResolver
{
    public function resolve(Node\Expr\BinaryOp\Coalesce $node): ResultContract
    {
        $left = $this->from($node->left);
        $right = $this->from($node->right);

        return RangerType::union($left, $right);
    }
}
