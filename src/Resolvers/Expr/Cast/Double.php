<?php

namespace Laravel\Ranger\Resolvers\Expr\Cast;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Double extends AbstractResolver
{
    public function resolve(Node\Expr\Cast\Double $node): ResultContract
    {
        return RangerType::int();
    }
}
