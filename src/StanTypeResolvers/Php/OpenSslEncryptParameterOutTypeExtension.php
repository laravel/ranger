<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class OpenSslEncryptParameterOutTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\OpenSslEncryptParameterOutTypeExtension $node): ResultContract
    {
        dd($node, 'OpenSslEncryptParameterOutTypeExtension not implemented yet');
    }
}
