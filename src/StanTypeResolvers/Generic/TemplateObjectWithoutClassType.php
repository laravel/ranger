<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateObjectWithoutClassType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateObjectWithoutClassType $node): ResultContract
    {
        dd($node, 'TemplateObjectWithoutClassType not implemented yet');
    }
}
