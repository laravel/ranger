<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexGroupList extends AbstractResolver
{
    public function resolve(Type\Regex\RegexGroupList $node): ResultContract
    {
        dd($node, 'RegexGroupList not implemented yet');
    }
}
