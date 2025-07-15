<?php

namespace Laravel\Ranger\StanTypeResolvers\Regex;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexExpressionHelper extends AbstractResolver
{
    public function resolve(Type\Regex\RegexExpressionHelper $node): ResultContract
    {
        dd($node, 'RegexExpressionHelper not implemented yet');
    }
}
