<?php

namespace Laravel\Ranger\Resolvers\Scalar;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Float_ extends AbstractResolver
{
    public function resolve(Node\Scalar\Float_ $node): ResultContract
    {
        return RangerType::int();
    }
}
