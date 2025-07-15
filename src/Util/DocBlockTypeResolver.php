<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;
use Laravel\Ranger\Types\Contracts\Type;
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

    public function collapseIntoRecord(iterable $records): string
    {
        $fields = [];
        $keys = [];
        $allFieldsOptional = false;

        foreach ($records as $record) {
            if (is_string($record)) {
                // TODO: Figure this out
                continue;
            }

            $keys[] = array_keys($record);

            if (count($record) === 0) {
                $allFieldsOptional = true;
            }

            foreach ($record as $key => $value) {
                $fields[$key] ??= [];
                $fields[$key][] = $value;
            }
        }

        $requiredKeys = array_intersect(...$keys);

        $final = ['{'];

        foreach ($fields as $key => $values) {
            $type = $key;

            $hasOptional = collect($values)->first(fn ($value) => $value instanceof Result && $value->isOptional()) !== null;

            if ($hasOptional || $allFieldsOptional || ! in_array($key, $requiredKeys)) {
                $type .= '?';
            }

            $types = collect($values)
                ->map(fn ($value) => $value instanceof Result && $value->isOptional() ? $value->value : $value)
                ->unique()
                ->sort()
                ->values()
                ->map(fn ($value) => is_array($value) ? TypeScript::objectToRecord($value, false).';' : $value);

            if ($types->count() > 1) {
                // We have an any in the mix, but we know the type from something else, so remove it
                $types = $types->filter(fn ($type) => $type !== 'any');
            }

            $type .= ': '.$types->implode(' | ');

            $final[] = TypeScript::indent($type, 1);
        }

        $final[] = '}';

        return implode(PHP_EOL, $final);
    }
}
