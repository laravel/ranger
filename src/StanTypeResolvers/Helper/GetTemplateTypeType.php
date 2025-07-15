<?php

namespace Laravel\Ranger\StanTypeResolvers\Helper;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GetTemplateTypeType extends AbstractResolver
{
    public function resolve(Type\Helper\GetTemplateTypeType $node): ResultContract
    {
        dd($node, 'GetTemplateTypeType not implemented yet');
    }
}
