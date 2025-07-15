<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateObjectType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateObjectType $node): ResultContract
    {
        dd($node, 'TemplateObjectType not implemented yet');
    }
}
