<?php

namespace Laravel\Ranger\DocBlockResolvers;

use Illuminate\Support\Arr;
use Laravel\Ranger\Util\DocBlockParser;
use Laravel\Ranger\Util\DocBlockTypeResolver;
use Laravel\Ranger\Util\Parser;
use Laravel\Ranger\Util\Reflector;
use PhpParser\Node\Expr\CallLike;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocNode;

abstract class AbstractResolver
{
    public function __construct(
        public DocBlockTypeResolver $typeResolver,
        protected Reflector $reflector,
        protected Parser $parser,
        protected DocBlockParser $docBlockParser,
        protected PhpDocNode $parsed,
        public array $context = [],
        protected ?CallLike $referenceNode = null,
    ) {
        //
    }

    protected function from(Node $node)
    {
        return $this->typeResolver->from($node, $this->context);
    }

    protected function union(...$types): string
    {
        return collect($types)
            ->map(fn ($type) => collect(Arr::wrap($type))->map(fn ($t) => explode('|', $t)))
            ->flatten()
            ->map(fn ($t) => trim($t))
            ->unique()
            ->implode(' | ');
    }
}
