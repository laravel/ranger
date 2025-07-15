<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateStringType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateStringType $node): ResultContract
    {
        dd($node, 'TemplateStringType not implemented yet');
    }
}
