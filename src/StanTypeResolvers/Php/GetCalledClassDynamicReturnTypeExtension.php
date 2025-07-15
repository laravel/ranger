<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class GetCalledClassDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\GetCalledClassDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'GetCalledClassDynamicReturnTypeExtension not implemented yet');
    }
}
