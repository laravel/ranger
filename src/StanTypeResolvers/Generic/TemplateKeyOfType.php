<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateKeyOfType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateKeyOfType $node): ResultContract
    {
        dd($node, 'TemplateKeyOfType not implemented yet');
    }
}
