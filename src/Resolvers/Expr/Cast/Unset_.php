<?php

namespace Laravel\Ranger\Resolvers\Expr\Cast;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Unset_ extends AbstractResolver
{
    public function resolve(Node\Expr\Cast\Unset_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
