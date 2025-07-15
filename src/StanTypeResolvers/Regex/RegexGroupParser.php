<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexGroupParser extends AbstractResolver
{
    public function resolve(Type\Regex\RegexGroupParser $node): ResultContract
    {
        dd($node, 'RegexGroupParser not implemented yet');
    }
}
