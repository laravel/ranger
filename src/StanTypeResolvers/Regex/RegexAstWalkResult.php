<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexAstWalkResult extends AbstractResolver
{
    public function resolve(Type\Regex\RegexAstWalkResult $node): ResultContract
    {
        dd($node, 'RegexAstWalkResult not implemented yet');
    }
}
