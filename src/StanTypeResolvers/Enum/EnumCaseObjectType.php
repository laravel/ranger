<?php

namespace Laravel\Ranger\StanTypeResolvers\Enum;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class EnumCaseObjectType extends AbstractResolver
{
    public function resolve(Type\Enum\EnumCaseObjectType $node): ResultContract
    {
        dd($node, 'EnumCaseObjectType not implemented yet');
    }
}
