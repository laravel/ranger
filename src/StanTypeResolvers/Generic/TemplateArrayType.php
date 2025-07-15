<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateArrayType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateArrayType $node): ResultContract
    {
        dd($node, 'TemplateArrayType not implemented yet');
    }
}
