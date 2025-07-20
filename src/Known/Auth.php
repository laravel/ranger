<?php

namespace Laravel\Ranger\Known;

use Laravel\Ranger\Collectors\Models;
use Laravel\Ranger\Types\Type;

class Auth
{
    public static function user()
    {
        $model = app(Models::class)->get('App\\Models\\User');

        if ($model) {
            return Type::string($model->name);
        }
    }
}
