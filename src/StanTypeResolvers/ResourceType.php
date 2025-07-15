<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class ResourceType extends AbstractResolver
{
    public function resolve(Type\ResourceType $node): ResultContract
    {
        dd($node, 'ResourceType not implemented yet');
    }
}
