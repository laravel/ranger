<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ParserNodeTypeToPHPStanType extends AbstractResolver
{
    public function resolve(Type\ParserNodeTypeToPHPStanType $node): ResultContract
    {
        dd($node, 'ParserNodeTypeToPHPStanType not implemented yet');
    }
}
