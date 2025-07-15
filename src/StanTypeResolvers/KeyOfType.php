<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class KeyOfType extends AbstractResolver
{
    public function resolve(Type\KeyOfType $node): ResultContract
    {
        dd($node, 'KeyOfType not implemented yet');
    }
}
