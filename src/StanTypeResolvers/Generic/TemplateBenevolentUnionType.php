<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateBenevolentUnionType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateBenevolentUnionType $node): ResultContract
    {
        dd($node, 'TemplateBenevolentUnionType not implemented yet');
    }
}
