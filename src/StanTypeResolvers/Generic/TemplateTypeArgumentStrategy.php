<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeArgumentStrategy extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeArgumentStrategy $node): ResultContract
    {
        dd($node, 'TemplateTypeArgumentStrategy not implemented yet');
    }
}
