<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class BcMathStringOrNullReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\BcMathStringOrNullReturnTypeExtension $node): ResultContract
    {
        dd($node, 'BcMathStringOrNullReturnTypeExtension not implemented yet');
    }
}
