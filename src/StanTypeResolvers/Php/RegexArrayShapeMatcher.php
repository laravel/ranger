<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class RegexArrayShapeMatcher extends AbstractResolver
{
    public function resolve(Type\Php\RegexArrayShapeMatcher $node): ResultContract
    {
        dd($node, 'RegexArrayShapeMatcher not implemented yet');
    }
}
