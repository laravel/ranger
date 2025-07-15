<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

class InertiaController extends Controller
{
    public function show()
    {
        return Inertia::render('Home', [
            'showNav' => true,
            'title' => 'Home',
            'keywords' => ['home', 'page'],
            'date' => now(),
            'url' => url('/'),
        ]);
    }

    public function multiReturn()
    {
        if (true) {
            return Inertia::render('Multi', [
                'first' => true,
                'second' => 'second',
                'third' => 3,
            ]);
        }

        return Inertia::render('Multi', [
            'first' => false,
            'second' => null,
        ]);
    }

    public function withParam(Request $request, User $user)
    {
        return Inertia::render('Posts/Show', [
            'isPublished' => fn () => $user->post->isPublished(),
            'isOwner' => fn () => $user->post->isOwner($request->user()),
            'title' => fn () => $user->post->title,
            'post' => fn () => array_merge(value(Inertia::getShared('server')), [
                'owner' => $user->name,
            ]),
        ]);
    }

    public function withVariable(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        return Inertia::render('Posts/Variable', [
            'isPublished' => fn () => $user->post->isPublished(),
            'isOwner' => fn () => $user->post->isOwner($request->user()),
            'title' => fn () => $user->post->title,
            'post' => fn () => array_merge(value(Inertia::getShared('server')), [
                'owner' => $user->name,
            ]),
        ]);
    }

    public function nestedReturns(Request $request, User $user)
    {
        $statuses = collect(['draft', 'published', 'archived'])
            ->map(fn ($status) => strtoupper($status))
            ->each(function () {
                //
            });

        return Inertia::render('Posts/NestedReturns', [
            'statuses' => $statuses,
        ]);
    }
}
