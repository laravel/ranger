<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class LtrimFunctionReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\LtrimFunctionReturnTypeExtension $node): ResultContract
    {
        dd($node, 'LtrimFunctionReturnTypeExtension not implemented yet');
    }
}
