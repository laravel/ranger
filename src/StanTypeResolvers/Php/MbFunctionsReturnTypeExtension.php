<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MbFunctionsReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\MbFunctionsReturnTypeExtension $node): ResultContract
    {
        dd($node, 'MbFunctionsReturnTypeExtension not implemented yet');
    }
}
