<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateUnionType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateUnionType $node): ResultContract
    {
        dd($node, 'TemplateUnionType not implemented yet');
    }
}
