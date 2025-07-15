<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class StrCaseFunctionsReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\StrCaseFunctionsReturnTypeExtension $node): ResultContract
    {
        dd($node, 'StrCaseFunctionsReturnTypeExtension not implemented yet');
    }
}
