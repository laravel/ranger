<?php

namespace Laravel\Ranger\StanTypeResolvers\Generic;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TemplateTypeVarianceMap extends AbstractResolver
{
    public function resolve(Type\Generic\TemplateTypeVarianceMap $node): ResultContract
    {
        dd($node, 'TemplateTypeVarianceMap not implemented yet');
    }
}
