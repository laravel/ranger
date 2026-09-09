<?php

use App\Http\Middleware\GlobalUrlDefaultsMiddleware;
use App\Http\Middleware\UrlDefaultsMiddleware;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Route as RouteFacade;
use Laravel\Ranger\Collectors\Routes;
use Laravel\Ranger\Components\Route;
use Laravel\Ranger\Support\RouteParameter;

// These tests register their middleware through afterResolving to mirror
// withMiddleware(), which only reaches the kernel once it resolves. Nothing here
// may resolve the kernel before the test body does, so this file deliberately
// collects routes on demand rather than in a beforeEach.
function localeParameter(string $uriFragment): RouteParameter
{
    return app(Routes::class)->collect()
        ->first(fn (Route $route) => str_contains($route->uri(), $uriFragment))
        ->parameters()
        ->first(fn (RouteParameter $parameter) => $parameter->name === 'locale');
}

it('resolves URL defaults from an aliased middleware', function () {
    $this->app->afterResolving(Kernel::class, fn ($kernel) => $kernel->setMiddlewareAliases([
        'url-defaults' => UrlDefaultsMiddleware::class,
    ]));

    RouteFacade::middleware('url-defaults')->get('/alias-defaults/{locale}', fn () => '');

    $locale = localeParameter('alias-defaults');

    expect($locale->optional)->toBeTrue();
    expect($locale->default)->toBe('en');
});

it('resolves URL defaults from a kernel middleware group', function () {
    $this->app->afterResolving(Kernel::class, fn ($kernel) => $kernel->setMiddlewareGroups([
        'tenant' => [UrlDefaultsMiddleware::class],
    ]));

    RouteFacade::middleware('tenant')->get('/kernel-group-defaults/{locale}', fn () => '');

    $locale = localeParameter('kernel-group-defaults');

    expect($locale->optional)->toBeTrue();
    expect($locale->default)->toBe('en');
});

it('resolves URL defaults from global middleware', function () {
    // Global middleware never reaches the router, so this only works if the defaults
    // are read off the kernel itself.
    $this->app->afterResolving(Kernel::class, fn ($kernel) => $kernel->setGlobalMiddleware([
        UrlDefaultsMiddleware::class,
    ]));

    RouteFacade::get('/global-defaults/{locale}', fn () => '');

    $locale = localeParameter('global-defaults');

    expect($locale->optional)->toBeTrue();
    expect($locale->default)->toBe('en');
});

it('drops URL defaults when the middleware is excluded by alias', function () {
    // Excluded middleware runs through the same alias map, so without the kernel's aliases
    // the exclusion is missed and the parameter is wrongly reported as optional.
    $this->app->afterResolving(Kernel::class, fn ($kernel) => $kernel->setMiddlewareAliases([
        'url-defaults' => UrlDefaultsMiddleware::class,
    ]));

    RouteFacade::middleware(UrlDefaultsMiddleware::class)
        ->withoutMiddleware('url-defaults')
        ->get('/excluded-defaults/{locale}', fn () => '');

    expect(localeParameter('excluded-defaults')->optional)->toBeFalse();
});

it('prefers route middleware defaults over global middleware defaults', function () {
    $this->app->afterResolving(Kernel::class, fn ($kernel) => $kernel->setGlobalMiddleware([
        GlobalUrlDefaultsMiddleware::class,
    ]));

    RouteFacade::middleware(UrlDefaultsMiddleware::class)
        ->get('/precedence-defaults/{locale}', fn () => '');

    expect(localeParameter('precedence-defaults')->default)->toBe('en');
});
