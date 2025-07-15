<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeMap extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeMap $node): ResultContract
    {
        dd($node, 'TemplateTypeMap not implemented yet');
    }
}
