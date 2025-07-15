<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateGenericObjectType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateGenericObjectType $node): ResultContract
    {
        dd($node, 'TemplateGenericObjectType not implemented yet');
    }
}
