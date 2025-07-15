<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class TriggerErrorDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\TriggerErrorDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'TriggerErrorDynamicReturnTypeExtension not implemented yet');
    }
}
