<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexAlternation extends AbstractResolver
{
    public function resolve(Type\Regex\RegexAlternation $node): ResultContract
    {
        dd($node, 'RegexAlternation not implemented yet');
    }
}
