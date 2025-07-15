<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class AssertThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\AssertThrowTypeExtension $node): ResultContract
    {
        dd($node, 'AssertThrowTypeExtension not implemented yet');
    }
}
