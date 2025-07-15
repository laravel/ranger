<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;
use Laravel\Ranger\Types\Contracts\Type;
use Laravel\Ranger\Types\Converters\ResultConverter;
use Laravel\Ranger\Types\Converters\TypeScriptConverter;
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

    public function collapseIntoRecord(iterable $records): string
    {
        $fields = [];
        $keys = [];
        $allFieldsOptional = false;

        foreach ($records as $record) {
            $recordValue = $record instanceof Result ? $record->value : $record;

            if (is_string($recordValue)) {
                // TODO: Figure this out
                continue;
            }

            $keys[] = array_keys($recordValue);

            if (count($recordValue) === 0) {
                $allFieldsOptional = true;
            }

            foreach ($recordValue as $key => $value) {
                $fields[$key] ??= [];
                $fields[$key][] = $value;
            }
        }

        $requiredKeys = array_intersect(...$keys);

        $final = ['{'];

        foreach ($fields as $key => $values) {
            $type = $key;

            $hasOptional = collect($values)->first(fn ($value) => $value->isOptional()) !== null;

            if ($hasOptional || $allFieldsOptional || ! in_array($key, $requiredKeys)) {
                $type .= '?';
            }

            $types = collect($values)
                ->map(fn ($value) => ResultConverter::to($value, TypeScriptConverter::class))
                ->unique()
                ->sort()
                ->values();

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

    public function collapseIntoVueRuntimeDeclarationRecord(iterable $records): string
    {
        $fields = [];
        $keys = [];
        $allFieldsOptional = false;

        foreach ($records as $record) {
            $recordValue = $record instanceof Result ? $record->value : $record;

            if (is_string($recordValue)) {
                // TODO: Figure this out
                continue;
            }

            $keys[] = array_keys($recordValue);

            if (count($recordValue) === 0) {
                $allFieldsOptional = true;
            }

            foreach ($recordValue as $key => $value) {
                $fields[$key] ??= [];
                $fields[$key][] = $value;
            }
        }

        $requiredKeys = array_intersect(...$keys);

        $final = ['{'];

        foreach ($fields as $key => $values) {
            $type = $key.': ';

            $hasOptional = collect($values)->first(fn ($value) => $value->isOptional()) !== null;
            $isOptional = $hasOptional || $allFieldsOptional || ! in_array($key, $requiredKeys);

            $types = collect($values)
                ->map(fn ($value) => $value->toVueRuntimeDeclaration())
                ->unique()
                ->sort()
                ->values();

            if ($types->count() > 1) {
                // We have an any in the mix, but we know the type from something else, so remove it
                $types = $types->filter(fn ($type) => $type !== 'any');
            }

            $type .= '{'.PHP_EOL;
            $type .= TypeScript::indent('type: '.$types->implode(' | ').',').PHP_EOL;
            $type .= TypeScript::indent('required: '.($isOptional ? 'false' : 'true').',').PHP_EOL;
            $type .= '}';

            $final[] = TypeScript::indent($type).',';
        }

        $final[] = '}';

        return implode(PHP_EOL, $final);
    }
}
