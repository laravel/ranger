<?php

namespace Laravel\Ranger\Collectors;

use Closure;
use Laravel\Ranger\Components\JsonResponse;
use Laravel\Ranger\Util\Parser;
use Laravel\Ranger\Util\TypeResolver;
use PhpParser\Node;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;

class Response
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
            $reflection = new ReflectionFunction($routeUses['uses']);
        } else {
            [$controller, $method] = explode('@', $routeUses['uses']);
            $classReflection = new ReflectionClass($controller);
            $reflection = $classReflection->getMethod($method);
        }

        $this->parsed = $this->parser->parse($reflection);

        return $this->getInertiaResponse($reflection) ?? $this->getJsonResponse($reflection) ?? [];
    }

    protected function getInertiaResponse(ReflectionFunction|ReflectionMethod $reflection): ?array
    {
        $nodes = $this->parser->nodeFinder()->find(
            $this->parsed,
            fn ($node) => (
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

        if (count($nodes) === 0) {
            return null;
        }

        $result = $this->processInertiaNodes($nodes);

        return $result;
    }

    protected function getJsonResponse(ReflectionFunction|ReflectionMethod $reflection): ?array
    {
        $node = null;

        $returns = collect($this->parser->nodeFinder()->find(
            $this->parsed,
            function ($n) use ($reflection, &$node) {
                if (
                    $n->getStartLine() < $reflection->getStartLine() ||
                    $n->getEndLine() > $reflection->getEndLine()
                ) {
                    return false;
                }

                $node ??= $n;

                if (! ($n instanceof Node\Stmt\Return_)) {
                    return false;
                }

                $parent = $n->getAttribute('parent');

                while ($parent && $parent !== $node) {
                    if ($parent instanceof Node\Expr\Closure) {
                        return false;
                    }

                    $parent = $parent->getAttribute('parent');
                }

                return $parent === $node;
            }
        ));

        if (count($returns) === 0) {
            return null;
        }

        $result = $this->processReturnNodes($returns);

        if (count($result) === 0) {
            return null;
        }

        return $result;
    }

    protected function processReturnNodes($returns): array
    {
        $renders = [];

        foreach ($returns as $return) {
            if (! $return->expr instanceof Node\Expr\Array_) {
                continue;
            }

            $data = [];

            foreach ($return->expr->items as $item) {
                if ($item->key && $item->key instanceof Node\Scalar\String_) {
                    $data[$item->key->value] = $this->typeResolver->setParsed($this->parsed)->from($item->value);
                }
            }

            $renders[] = new JsonResponse($data);
        }

        return $renders;
    }

    /**
     * @param  Node[]  $nodes
     */
    protected function processInertiaNodes(array $nodes): array
    {
        $results = [];

        foreach ($nodes as $node) {
            if (! isset($node->args[1])) {
                InertiaComponents::addComponent($node->args[0]->value->value, []);
                $results[] = $node->args[0]->value->value;

                continue;
            }

            if (! $node->args[1]->value instanceof Node\Expr\Array_) {
                continue;
            }

            $data = [];

            foreach ($node->args[1]->value->items as $item) {
                if ($item->key && $item->key instanceof Node\Scalar\String_) {
                    $data[$item->key->value] = $this->typeResolver->setParsed($this->parsed)->from($item->value);
                }
            }

            InertiaComponents::addComponent($node->args[0]->value->value, $data);
            $results[] = $node->args[0]->value->value;
        }

        return $results;
    }
}
