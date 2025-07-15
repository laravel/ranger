<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class HashFunctionsReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\HashFunctionsReturnTypeExtension $node): ResultContract
    {
        dd($node, 'HashFunctionsReturnTypeExtension not implemented yet');
    }
}
