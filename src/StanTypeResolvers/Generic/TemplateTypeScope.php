<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeScope extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeScope $node): ResultContract
    {
        dd($node, 'TemplateTypeScope not implemented yet');
    }
}
