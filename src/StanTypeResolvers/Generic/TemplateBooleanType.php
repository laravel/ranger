<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateBooleanType extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateBooleanType $node): ResultContract
    {
        dd($node, 'TemplateBooleanType not implemented yet');
    }
}
