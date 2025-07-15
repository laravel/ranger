<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Illuminate\Support\Arr;
use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Resolvers\Concerns\ResolvesProperties;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class NullsafePropertyFetch extends AbstractResolver
{
    use ResolvesProperties;

    public function resolve(Node\Expr\NullsafePropertyFetch $node): ResultContract
    {
        $type = $this->resolveProperty($node);

        // dd($node, $type);

        // if (! in_array('null', $type)) {
        //     $type[] = 'null';
        // }

        return RangerType::union(...Arr::wrap($type))->nullable();
    }
}
