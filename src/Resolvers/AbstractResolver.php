<?php

namespace Laravel\Ranger\Resolvers;

use Laravel\Ranger\Types\Contracts\Type;
use Laravel\Ranger\Util\DocBlockParser;
use Laravel\Ranger\Util\Parser;
use Laravel\Ranger\Util\Reflector;
use Laravel\Ranger\Util\Stan;
use Laravel\Ranger\Util\TypeResolver;
use PhpParser\NodeAbstract;
use PHPStan\Analyser\Scope;

abstract class AbstractResolver
{
    protected Scope $scope;

    public function __construct(
        public TypeResolver $typeResolver,
        protected Reflector $reflector,
        protected Parser $parser,
        protected DocBlockParser $docBlockParser,
        protected array $parsed,
        protected Stan $stan,
        public array $context = [],
    ) {
        //
    }

    protected function getStanType(NodeAbstract $node): string|Type|null
    {
        return $this->stan->getType($node);
    }

    protected function from(NodeAbstract $node)
    {
        return $this->typeResolver->from($node, $this->context);
    }
}
