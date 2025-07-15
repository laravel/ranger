<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Variable extends AbstractResolver
{
    public function resolve(Node\Expr\Variable $node): ResultContract
    {
        $class = $this->parser->nodeFinder()->findFirst(
            $this->parsed,
            fn ($n) => $n instanceof Node\Stmt\Class_
        );

        if (! $class) {
            // TODO: Handle case where no class is found, fallback to a closure
            return RangerType::mixed();
        }

        if ($node->name === 'this') {
            return RangerType::string($class->namespacedName->name);
        }

        $method = $this->parser->nodeFinder()->findFirst(
            $this->parsed,
            fn ($n) => $n instanceof Node\Stmt\ClassMethod &&
                $n->getStartLine() <= $node->getStartLine() &&
                $n->getEndLine() >= $node->getEndLine()
        );

        if (! $method) {
            return RangerType::mixed();
        }

        $paramType = $this->reflector->methodParamType($class->namespacedName->name, $method->name->name, $node->name);

        if ($paramType) {
            return $paramType;
        }

        $assignmentExpression = $this->parser->nodeFinder()->findFirst(
            $method,
            fn ($n) => $n instanceof Node\Stmt\Expression &&
                $n->expr instanceof Node\Expr\Assign &&
                $n->expr->var instanceof Node\Expr\Variable &&
                $n->expr->var->name === $node->name
        );

        if (! $assignmentExpression) {
            return RangerType::mixed();
        }

        $docBlock = $assignmentExpression->getDocComment();

        if ($docBlock && ($parsed = $this->docBlockParser->parseVar($docBlock))) {
            return $parsed;
        }

        return $this->from($assignmentExpression->expr->expr);
    }
}
