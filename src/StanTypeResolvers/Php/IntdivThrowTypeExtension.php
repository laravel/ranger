<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class IntdivThrowTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\IntdivThrowTypeExtension $node): ResultContract
    {
        dd($node, 'IntdivThrowTypeExtension not implemented yet');
    }
}
