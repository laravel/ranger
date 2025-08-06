<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;
use PhpParser\Node\Expr\CallLike;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocNode;

class DocBlockTypeResolver
{
    protected PhpDocNode $parsed;

    protected ?CallLike $referenceNode = null;

    public function setReferenceNode(?CallLike $node = null): self
    {
        $this->referenceNode = $node;

        return $this;
    }

    public function setParsed(PhpDocNode $parsed): self
    {
        $this->parsed = $parsed;

        return $this;
    }

    public function from(Node $node, array $context = [])
    {
        $className = str(get_class($node))->after('Ast\\')->prepend('Laravel\\Ranger\\DocBlockResolvers\\')->toString();

        if (! class_exists($className)) {
            dd("Class {$className} does not exist");
        }

        Debug::log("Resolving {$className}");

        return app($className, [
            'typeResolver' => $this,
            'context' => $context,
            'parsed' => $this->parsed,
            'referenceNode' => $this->referenceNode,
        ])->resolve($node);
    }
}
