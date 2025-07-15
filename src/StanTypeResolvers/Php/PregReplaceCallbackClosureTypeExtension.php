<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class PregReplaceCallbackClosureTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\PregReplaceCallbackClosureTypeExtension $node): ResultContract
    {
        dd($node, 'PregReplaceCallbackClosureTypeExtension not implemented yet');
    }
}
