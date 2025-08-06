<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;

class StanTypeResolver
{
    protected array $parsed = [];

    public function from($node)
    {
        $className = str(get_class($node))->after('Type\\')->prepend('Laravel\\Ranger\\StanTypeResolvers\\')->toString();

        if (! class_exists($className)) {
            dd("Class {$className} does not exist");
        }

        Debug::log("Resolving {$className}");

        return app($className, [
            'typeResolver' => $this,
        ])->resolve($node);
    }
}
