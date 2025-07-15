<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class Array_ extends AbstractResolver
{
    public function resolve(Node\Expr\Array_ $node): ResultContract
    {
        $items = collect($node->items);

        $isList = $items->every(fn ($item) => $item->key === null);

        if ($isList) {
            return RangerType::array(
                $items->map(fn ($item) => $this->from($item->value))->unique()->values(),
            );
            // $types = $items->map(fn($item) => $this->from($item->value))->unique()->implode(' | ');

            // if (substr_count($types, ' | ') > 0) {
            //     return "({ $types })[]";
            // }

            // return "{$types}[]";
        }

        return RangerType::array(
            $items
                ->mapWithKeys(fn ($item) => [
                    $item->key->value ?? null => $this->from($item->value),
                ])
                ->toArray(),
        );
    }
}
