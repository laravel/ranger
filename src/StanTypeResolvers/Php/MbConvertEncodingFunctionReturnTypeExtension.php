<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MbConvertEncodingFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\MbConvertEncodingFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'MbConvertEncodingFunctionReturnTypeExtension not implemented yet');
    }
}
