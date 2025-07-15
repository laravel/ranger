<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateObjectShapeType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateObjectShapeType $node): ResultContract
    {
        dd($node, 'TemplateObjectShapeType not implemented yet');
    }
}
