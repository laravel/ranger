<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CircularTypeAliasDefinitionException extends AbstractResolver
{
    public function resolve(Type\CircularTypeAliasDefinitionException $node): ResultContract
    {
        dd($node, 'CircularTypeAliasDefinitionException not implemented yet');
    }
}
