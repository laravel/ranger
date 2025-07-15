<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateFloatType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateFloatType $node): ResultContract
    {
        dd($node, 'TemplateFloatType not implemented yet');
    }
}
