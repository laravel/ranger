<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateConstantStringType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateConstantStringType $node): ResultContract
    {
        dd($node, 'TemplateConstantStringType not implemented yet');
    }
}
