<?php

namespace Laravel\Ranger\Resolvers\Scalar;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Int_ extends AbstractResolver
{
    public function resolve(Node\Scalar\Int_ $node): ResultContract
    {
        return RangerType::int();
    }
}
