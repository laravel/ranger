<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class CtypeDigitFunctionTypeSpecifyingExtension extends AbstractResolver
{
    public function resolve(Type\Php\CtypeDigitFunctionTypeSpecifyingExtension $node): ResultContract
    {
        dd($node, 'CtypeDigitFunctionTypeSpecifyingExtension not implemented yet');
    }
}
