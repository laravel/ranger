<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class BcMathNumberOperatorTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\BcMathNumberOperatorTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'BcMathNumberOperatorTypeSpecifyingExtension not implemented yet');
    }
}
