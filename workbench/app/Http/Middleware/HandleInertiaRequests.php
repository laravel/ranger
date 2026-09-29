<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => fn () => [
                'user' => $request->user(),
            ],
            'flash' => fn () => [
                'success' => $request->session()->get('success'),
            ],
        ];
    }

    public function shareOnce(Request $request): array
    {
        return [
            ...parent::shareOnce($request),
            'locale' => fn () => app()->getLocale(),
        ];
    }
}
