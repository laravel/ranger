<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexCapturingGroup extends AbstractResolver
{
    public function resolve(Type\Regex\RegexCapturingGroup $node): ResultContract
    {
        dd($node, 'RegexCapturingGroup not implemented yet');
    }
}
