<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexNonCapturingGroup extends AbstractResolver
{
    public function resolve(Type\Regex\RegexNonCapturingGroup $node): ResultContract
    {
        dd($node, 'RegexNonCapturingGroup not implemented yet');
    }
}
