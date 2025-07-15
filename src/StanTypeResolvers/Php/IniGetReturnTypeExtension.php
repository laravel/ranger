<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IniGetReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\IniGetReturnTypeExtension $node): ResultContract
    {
        dd($node, 'IniGetReturnTypeExtension not implemented yet');
    }
}
