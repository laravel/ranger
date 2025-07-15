<?php

namespace Laravel\Ranger\Resolvers\Expr\Cast;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Int_ extends AbstractResolver
{
    public function resolve(Node\Expr\Cast\Int_ $node): ResultContract
    {
        return RangerType::int();
    }
}
