<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\URL;

class QuotedUrlDefaultsMiddleware
{
    public function handle($request, $next)
    {
        URL::defaults([
            'doubleQuoted' => 'say "hi"',
            'singleQuoted' => "it's here",
            'escaped' => "it's \"quoted\"",
            'flag' => true,
            'word' => 'true',
        ]);

        return $next($request);
    }
}
