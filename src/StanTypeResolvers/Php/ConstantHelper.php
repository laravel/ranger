<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ConstantHelper extends AbstractResolver
{
    public function resolve(Type\Php\ConstantHelper $node): ResultContract
    {
        dd($node, 'ConstantHelper not implemented yet');
    }
}
