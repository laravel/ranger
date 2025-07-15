<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class ArrayDimFetch extends AbstractResolver
{
    public function resolve(Node\Expr\ArrayDimFetch $node): ResultContract
    {
        $var = $this->from($node->var);

        if (! is_array($var)) {
            return $var;
        }

        if ($node->dim instanceof Node\Scalar\String_) {
            return $var[$node->dim->value] ?? RangerType::mixed();
        }

        if ($node->dim instanceof Node\Scalar\LNumber) {
            return $var[$node->dim->value] ?? RangerType::mixed();
        }

        dd('Unsupported ArrayDimFetch dim type', $node->dim);

        return RangerType::mixed();
    }
}
