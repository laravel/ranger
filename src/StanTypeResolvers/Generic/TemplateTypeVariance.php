<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeVariance extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeVariance $node): ResultContract
    {
        dd($node, 'TemplateTypeVariance not implemented yet');
    }
}
