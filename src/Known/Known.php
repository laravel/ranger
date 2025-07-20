<?php

namespace Laravel\Ranger\Known;

use Illuminate\Support\Facades\Auth as AuthFacade;
use Illuminate\Support\Facades\Request as RequestFacade;

class Known
{
    protected static $mapping = [
        RequestFacade::class => Request::class,
        AuthFacade::class => Auth::class,
    ];

    public static function resolve(string $class, string $method, ...$args)
    {
        if (! isset(self::$mapping[$class])) {
            return false;
        }

        if (! method_exists(self::$mapping[$class], $method)) {
            return false;
        }

        return call_user_func_array([self::$mapping[$class], $method], $args);
    }
}
