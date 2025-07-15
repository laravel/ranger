<?php

namespace Laravel\Ranger\Resolvers\Expr\Cast;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Bool_ extends AbstractResolver
{
    public function resolve(Node\Expr\Cast\Bool_ $node): ResultContract
    {
        return RangerType::bool();
    }
}
