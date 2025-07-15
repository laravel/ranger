<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use Laravel\Ranger\Util\TypeResolver;
use PHPStan\PhpDocParser\Ast;

class ConditionalTypeForParameterNode extends AbstractResolver
{
    public function resolve(Ast\Type\ConditionalTypeForParameterNode $node): ResultContract
    {
        $arg = $this->getArgForConditional($node);

        if (! $arg) {
            return RangerType::union(
                ...collect([$node->if, $node->else])
                    ->map(fn ($type) => $this->from($type))
                    ->unique(),
            );
        }

        $argType = app(TypeResolver::class)->from($arg->value);

        $targetType = $this->from($node->targetType);

        if ($targetType === 'class-string' && class_exists($argType)) {
            return $node->negated ? $this->from($node->else) : $this->from($node->if);
        }

        if ($argType === $targetType && ! $node->negated) {
            return $this->from($node->if);
        }

        return $this->from($node->else);
    }

    protected function getArgForConditional(Ast\Type\ConditionalTypeForParameterNode $node): mixed
    {
        if (! $this->referenceNode) {
            return null;
        }

        $paramName = ltrim($node->parameterName, '$');

        $arg = collect($this->referenceNode->getArgs())->first(fn ($arg) => $arg->name?->name === $paramName);

        if ($arg) {
            return $arg;
        }

        $index = collect($this->parsed->getParamTagValues())->search(fn ($param) => $param->parameterName === $node->parameterName);

        if ($index === false) {
            return null;
        }

        return $this->referenceNode->getArgs()[$index] ?? null;
    }
}
