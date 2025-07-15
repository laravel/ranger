<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Illuminate\Support\Arr;
use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class NullsafeMethodCall extends AbstractResolver
{
    public function resolve(Node\Expr\NullsafeMethodCall $node): ResultContract
    {
        $type = $this->from($node->var);

        $type = Arr::wrap($type);

        if (! in_array('null', $type)) {
            $type[] = RangerType::null();
        }

        return RangerType::union(...$type);
    }
}
