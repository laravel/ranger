<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateIterableType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateIterableType $node): ResultContract
    {
        dd($node, 'TemplateIterableType not implemented yet');
    }
}
