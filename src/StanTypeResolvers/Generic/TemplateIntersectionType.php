<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateIntersectionType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateIntersectionType $node): ResultContract
    {
        dd($node, 'TemplateIntersectionType not implemented yet');
    }
}
