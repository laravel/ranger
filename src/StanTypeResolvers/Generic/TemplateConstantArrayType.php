<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateConstantArrayType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateConstantArrayType $node): ResultContract
    {
        dd($node, 'TemplateConstantArrayType not implemented yet');
    }
}
