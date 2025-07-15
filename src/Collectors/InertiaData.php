<?php

namespace Laravel\Ranger\Collectors;

use Closure;
use Laravel\Ranger\Components\InertiaResponse;
use Laravel\Ranger\Util\Parser;
use Laravel\Ranger\Util\TypeResolver;
use PhpParser\Node;

class InertiaData
{
    protected array $parsed = [];

    public function __construct(
        protected Parser $parser,
        protected TypeResolver $typeResolver,
    ) {
        //
    }

    public function parseResponse(array $routeUses): array
    {
        if ($routeUses['uses'] instanceof Closure) {
            $reflection = new \ReflectionFunction($routeUses['uses']);
        } else {
            [$controller, $method] = explode('@', $routeUses['uses']);
            $classReflection = new \ReflectionClass($controller);
            $reflection = $classReflection->getMethod($method);
        }

        $contents = file_get_contents($reflection->getFileName());

        $parsed = $this->parse($contents);

        $nodes = $this->parser->nodeFinder()->find(
            $parsed,
            fn($node) => (
                $node->getStartLine() >= $reflection->getStartLine() &&
                $node->getEndLine() <= $reflection->getEndLine()
            ) && ((
                $node instanceof Node\Expr\StaticCall &&
                $node->class instanceof Node\Name\FullyQualified &&
                $node->class->toString() === 'Inertia\\Inertia' &&
                $node->name->toString() === 'render'
            ) || (
                $node instanceof Node\Expr\FuncCall &&
                $node->name->toString() === 'inertia'
            )),
        );

        $result = $this->processNodes($nodes);

        $this->parsed = [];

        return $result;
    }

    protected function parse(string $contents)
    {
        // TODO: Is this doing anything?
        if (count($this->parsed) > 0) {
            return $this->parsed;
        }

        $this->parsed = $this->parser->parse($contents);

        return $this->parsed;
    }

    /**
     * @param  Node[]  $nodes
     */
    protected function processNodes(array $nodes): array
    {
        $renders = [];

        foreach ($nodes as $node) {
            if (! isset($node->args[1]) || ! $node->args[1]->value instanceof Node\Expr\Array_) {
                continue;
            }

            $data = [];

            foreach ($node->args[1]->value->items as $item) {
                if ($item->key && $item->key instanceof Node\Scalar\String_) {
                    $data[$item->key->value] = $this->typeResolver->setParsed($this->parsed)->from($item->value);
                }
            }

            $renders[] = new InertiaResponse($node->args[0]->value->value, $data);
        }

        return $renders;
    }
}
