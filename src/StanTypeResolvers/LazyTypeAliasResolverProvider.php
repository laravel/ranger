<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class LazyTypeAliasResolverProvider extends AbstractResolver
{
    public function resolve(Type\LazyTypeAliasResolverProvider $node): ResultContract
    {
        dd($node, 'LazyTypeAliasResolverProvider not implemented yet');
    }
}
