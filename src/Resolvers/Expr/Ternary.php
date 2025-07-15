<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Ternary extends AbstractResolver
{
    public function resolve(Node\Expr\Ternary $node): ResultContract
    {
        $if = $this->from($node->if);
        $else = $this->from($node->else);

        return RangerType::union($if, $else);
    }
}
