<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeReference extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeReference $node): ResultContract
    {
        dd($node, 'TemplateTypeReference not implemented yet');
    }
}
