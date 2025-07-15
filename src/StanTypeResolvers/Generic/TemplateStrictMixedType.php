<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateStrictMixedType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateStrictMixedType $node): ResultContract
    {
        dd($node, 'TemplateStrictMixedType not implemented yet');
    }
}
