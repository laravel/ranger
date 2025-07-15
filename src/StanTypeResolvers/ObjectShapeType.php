<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\Type;

class ObjectShapeType extends AbstractResolver
{
    public function resolve(Type\ObjectShapeType $node): ResultContract
    {
        if (count($node->getOptionalProperties())) {
            dd($node, 'got optional properties');
        }

        return RangerType::array(collect($node->getProperties())->map(fn ($prop) => $this->from($prop)));
    }
}
