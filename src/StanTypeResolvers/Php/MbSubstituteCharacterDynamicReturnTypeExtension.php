<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class MbSubstituteCharacterDynamicReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\MbSubstituteCharacterDynamicReturnTypeExtension $node): ResultContract
    {
        dd($node, 'MbSubstituteCharacterDynamicReturnTypeExtension not implemented yet');
    }
}
