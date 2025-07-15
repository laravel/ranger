<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PhpParser\Node;

class Const_ extends AbstractResolver
{
    public function resolve(Node\Const_ $node): ResultContract
    {
        dd($node, get_class($this).' not implemented yet');
    }
}
