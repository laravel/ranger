<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ParseStrParameterOutTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\ParseStrParameterOutTypeExtension $node): ResultContract
    {
        dd($node, 'ParseStrParameterOutTypeExtension not implemented yet');
    }
}
