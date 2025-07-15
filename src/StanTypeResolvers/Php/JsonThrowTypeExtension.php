<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class JsonThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\JsonThrowTypeExtension $node): ResultContract
    {
        dd($node, 'JsonThrowTypeExtension not implemented yet');
    }
}
