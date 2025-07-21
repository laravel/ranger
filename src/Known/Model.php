<?php

namespace Laravel\Ranger\Known;

use Laravel\Ranger\Collectors\Models;
use Laravel\Ranger\Components\Model as ModelComponent;
use Laravel\Ranger\Types\Type;

class Model
{
    protected static ModelComponent $model;

    public static function setModel(string|ModelComponent $model): void
    {
        if ($model instanceof ModelComponent) {
            self::$model = $model;
        } elseif (is_string($model)) {
            self::$model = app(Models::class)->get($model);
        } else {
            throw new \InvalidArgumentException('Model must be a string or an instance of ModelComponent.');
        }
    }

    public static function get()
    {
        // TODO: Do this better
        return Type::arrayShape(Type::int(), Type::string(self::$model->name));
    }
}
