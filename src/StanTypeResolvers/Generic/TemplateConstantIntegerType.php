<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateConstantIntegerType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateConstantIntegerType $node): ResultContract
    {
        dd($node, 'TemplateConstantIntegerType not implemented yet');
    }
}
