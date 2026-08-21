<?php

namespace App\Http\Middleware;

use App\Attributes\Ignore;
use Inertia\Middleware;

class HandleInertiaRequestsWithMarkedShare extends Middleware
{
    #[Ignore]
    public function share($request): array
    {
        return [
            'secret' => 'value',
        ];
    }
}
