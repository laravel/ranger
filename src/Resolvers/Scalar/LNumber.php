<?php

namespace Laravel\Ranger\Resolvers\Scalar;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class LNumber extends AbstractResolver
{
    public function resolve(Node\Scalar\LNumber $node): ResultContract
    {
        return RangerType::int();
    }
}
