<?php

namespace Laravel\Ranger\Resolvers\Scalar;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class DNumber extends AbstractResolver
{
    public function resolve(Node\Scalar\DNumber $node): ResultContract
    {
        return RangerType::int();
    }
}
