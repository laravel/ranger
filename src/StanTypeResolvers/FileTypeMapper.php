<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\Type;

class FileTypeMapper extends AbstractResolver
{
    public function resolve(Type\FileTypeMapper $node): ResultContract
    {
        dd($node, 'FileTypeMapper not implemented yet');
    }
}
