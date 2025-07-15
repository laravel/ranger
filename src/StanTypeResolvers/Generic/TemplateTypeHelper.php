<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeHelper extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeHelper $node): ResultContract
    {
        dd($node, 'TemplateTypeHelper not implemented yet');
    }
}
