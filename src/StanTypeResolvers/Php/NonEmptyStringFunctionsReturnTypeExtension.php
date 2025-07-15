<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class NonEmptyStringFunctionsReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\NonEmptyStringFunctionsReturnTypeExtension $node): ResultContract
    {
        dd($node, 'NonEmptyStringFunctionsReturnTypeExtension not implemented yet');
    }
}
