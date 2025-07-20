<?php

namespace Laravel\Ranger\Known;

use Laravel\Ranger\Types\Type;
use PhpParser\Node\Arg;

class Request
{
    public static function all(...$args)
    {
        if (count($args) === 0) {
            return Type::arrayShape(Type::string(), Type::mixed());
        }

        return Type::array(collect($args)->mapWithKeys(fn (Arg $arg) => [
            $arg->value->value => Type::mixed(),
        ])->all());
    }
}
