<?php

namespace Laravel\Ranger\StanTypeResolvers\Php;

use Laravel\Ranger\StanTypeResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class XMLReaderOpenReturnTypeExtension extends AbstractResolver
{
    public function resolve(Type\Php\XMLReaderOpenReturnTypeExtension $node): ResultContract
    {
        dd($node, 'XMLReaderOpenReturnTypeExtension not implemented yet');
    }
}
