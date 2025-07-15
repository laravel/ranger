<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeFactory extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeFactory $node): ResultContract
    {
        dd($node, 'TemplateTypeFactory not implemented yet');
    }
}
