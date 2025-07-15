<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class VerbosityLevel extends AbstractResolver
{
    public function resolve(Type\VerbosityLevel $node): ResultContract
    {
        dd($node, 'VerbosityLevel not implemented yet');
    }
}
