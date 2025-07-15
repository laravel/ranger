<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class ConstFetch extends AbstractResolver
{
    public function resolve(Node\Expr\ConstFetch $node): ResultContract
    {
        if (in_array($node->name->toString(), ['true', 'false'])) {
            return RangerType::bool();
        }

        if ($node->name->toString() === 'null') {
            return RangerType::null();
        }

        dd('ConstFetch not implemented yet for ', $node);
    }
}
