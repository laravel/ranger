<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateMixedType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateMixedType $node): ResultContract
    {
        dd($node, 'TemplateMixedType not implemented yet');
    }
}
