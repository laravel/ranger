<?php

namespace Laravel\Ranger\StanTypeResolvers\Constant;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class OversizedArrayBuilder extends AbstractResolver
{
    public function resolve(Type\Constant\OversizedArrayBuilder $node): ResultContract
    {
        dd($node, 'OversizedArrayBuilder not implemented yet');
    }
}
