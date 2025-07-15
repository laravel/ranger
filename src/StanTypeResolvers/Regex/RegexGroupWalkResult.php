<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexGroupWalkResult extends AbstractResolver
{
    public function resolve(Type\Regex\RegexGroupWalkResult $node): ResultContract
    {
        dd($node, 'RegexGroupWalkResult not implemented yet');
    }
}
