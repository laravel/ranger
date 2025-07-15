<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Instanceof_ extends AbstractResolver
{
    public function resolve(Node\Expr\Instanceof_ $node): ResultContract
    {
        return RangerType::bool();
    }
}
