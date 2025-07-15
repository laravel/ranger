<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class LooseComparisonHelper extends AbstractResolver
{
    public function resolve(Type\LooseComparisonHelper $node): ResultContract
    {
        dd($node, 'LooseComparisonHelper not implemented yet');
    }
}
