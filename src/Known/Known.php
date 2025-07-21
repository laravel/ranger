<?php

namespace Laravel\Ranger\Known;

use Illuminate\Support\Facades\Auth as AuthFacade;
use Illuminate\Support\Facades\Request as RequestFacade;
use Laravel\Ranger\Collectors\Models;

class Known
{
    protected static $mapping = [
        RequestFacade::class => Request::class,
        AuthFacade::class => Auth::class,
    ];

    public static function resolve(string $class, string $method, ...$args)
    {
        if (! isset(self::$mapping[$class])) {
            $model = app(Models::class)->get($class);

            if ($model && method_exists(Model::class, $method)) {
                Model::setModel($model);

                return call_user_func_array([Model::class, $method], $args);
            }

            return false;
        }

        if (! method_exists(self::$mapping[$class], $method)) {
            return false;
        }

        return call_user_func_array([self::$mapping[$class], $method], $args);
    }
}
