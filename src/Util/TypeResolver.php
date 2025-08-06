<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;
use PhpParser\NodeAbstract;

class TypeResolver
{
    protected array $parsed = [];

    public function setParsed(array $parsed): self
    {
        $this->parsed = $parsed;

        return $this;
    }

    public function from(NodeAbstract $node, array $context = [])
    {
        $className = str(get_class($node))->after('Node\\')->prepend('Laravel\\Ranger\\Resolvers\\')->toString();

        if (! class_exists($className)) {
            dd("Class {$className} does not exist");
        }

        Debug::log("Resolving {$className}");

        return app($className, [
            'typeResolver' => $this,
            'context' => $context,
            'parsed' => $this->parsed,
        ])->resolve($node);
    }
}
