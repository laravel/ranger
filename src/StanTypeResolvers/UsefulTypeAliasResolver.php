<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class UsefulTypeAliasResolver extends AbstractResolver
{
    public function resolve(Type\UsefulTypeAliasResolver $node): ResultContract
    {
        dd($node, 'UsefulTypeAliasResolver not implemented yet');
    }
}
