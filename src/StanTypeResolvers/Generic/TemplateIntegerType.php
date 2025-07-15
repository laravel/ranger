<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateIntegerType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateIntegerType $node): ResultContract
    {
        dd($node, 'TemplateIntegerType not implemented yet');
    }
}
