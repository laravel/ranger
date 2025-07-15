<?php

namespace Laravel\Ranger\Resolvers\Name;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class FullyQualified extends AbstractResolver
{
    public function resolve(Node\Name\FullyQualified $node): ResultContract
    {
        return RangerType::string($node->name);
    }
}
