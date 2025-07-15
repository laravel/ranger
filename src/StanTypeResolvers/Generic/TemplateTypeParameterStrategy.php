<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeParameterStrategy extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeParameterStrategy $node): ResultContract
    {
        dd($node, 'TemplateTypeParameterStrategy not implemented yet');
    }
}
