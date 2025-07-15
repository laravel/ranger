<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class DirectTypeAliasResolverProvider extends AbstractResolver
{
    public function resolve(Type\DirectTypeAliasResolverProvider $node): ResultContract
    {
        dd($node, 'DirectTypeAliasResolverProvider not implemented yet');
    }
}
