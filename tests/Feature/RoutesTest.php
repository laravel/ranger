<?php

use App\Http\Controllers\InvokableController;
use App\Http\Controllers\PostController;
use Laravel\Ranger\Collectors\Routes;
use Laravel\Ranger\Components\Route;
use Laravel\Ranger\Components\Verb;
use Laravel\Ranger\Support\RouteParameter;

beforeEach(function () {
    $this->collector = app(Routes::class);
    $this->routes = $this->collector->collect();
});

describe('route collection', function () {
    it('collects routes from the application', function () {
        expect($this->routes)->not->toBeEmpty();
    });
});

describe('named routes', function () {
    it('captures route names correctly', function () {
        $homeRoute = $this->routes->first(fn (Route $r) => $r->name() === 'home');
        $dashboardRoute = $this->routes->first(fn (Route $r) => $r->name() === 'dashboard');

        expect($homeRoute)->not->toBeNull();
        expect($dashboardRoute)->not->toBeNull();
    });

    it('returns null for unnamed routes', function () {
        $closureRoute = $this->routes->first(fn (Route $r) => str_contains($r->uri(), 'closure'));

        expect($closureRoute->name())->toBeNull();
    });

    it('handles namespaced route names', function () {
        $packageRoute = $this->routes->first(fn (Route $r) => str_contains($r->name() ?? '', 'my-package'));

        expect($packageRoute)->not->toBeNull();
        expect($packageRoute->name())->toBe('namespaced.my-package.store');
    });

    it('returns null for generated route names', function () {
        $routes = $this->routes->filter(fn (Route $r) => str_starts_with($r->name() ?? '', 'generated::'));

        expect($routes)->toBeEmpty();
    });
});

describe('route methods/verbs', function () {
    it('captures GET routes', function () {
        $getRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.index');
        $verbs = $getRoute->verbs();

        expect($verbs)->toHaveCount(2);
        expect($verbs->first())->toBeInstanceOf(Verb::class);
        expect($verbs->first()->actual)->toBe('get');
    });

    it('captures POST routes', function () {
        $postRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.store');
        $verbs = $postRoute->verbs();

        expect($verbs->first()->actual)->toBe('post');
    });

    it('captures PATCH routes', function () {
        $patchRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.update');
        $verbs = $patchRoute->verbs();

        expect($verbs->first()->actual)->toBe('patch');
    });

    it('captures DELETE routes', function () {
        $deleteRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.destroy');
        $verbs = $deleteRoute->verbs();

        expect($verbs->first()->actual)->toBe('delete');
    });
});

describe('controller detection', function () {
    it('detects controller-based routes', function () {
        $controllerRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.index');

        expect($controllerRoute->hasController())->toBeTrue();
        expect($controllerRoute->controller())->toBe('\\'.PostController::class);
    });

    it('detects closure-based routes', function () {
        $closureRoute = $this->routes->first(fn (Route $r) => $r->name() === 'home');

        expect($closureRoute->controller())->toBe('\\Closure');
    });

    it('detects invokable controllers', function () {
        $invokableRoute = $this->routes->first(
            fn (Route $r) => str_contains($r->uri(), 'invokable-controller') && ! str_contains($r->uri(), 'plus')
        );

        expect($invokableRoute->hasInvokableController())->toBeTrue();
        expect($invokableRoute->controller())->toBe('\\'.InvokableController::class);
        expect($invokableRoute->method())->toBe('__invoke');
    });

    it('returns correct method name for controller actions', function () {
        $indexRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.index');
        $showRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.show');

        expect($indexRoute->method())->toBe('index');
        expect($showRoute->method())->toBe('show');
    });
});

describe('route parameters', function () {
    it('captures required route parameters', function () {
        $showRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.show');
        $params = $showRoute->parameters();

        expect($params)->toHaveCount(1);
        expect($params->first())->toBeInstanceOf(RouteParameter::class);
        expect($params->first()->name)->toBe('post');
        expect($params->first()->optional)->toBeFalse();
    });

    it('captures optional route parameters', function () {
        $optionalRoute = $this->routes->first(fn (Route $r) => $r->name() === 'optional');
        $params = $optionalRoute->parameters();

        expect($params)->toHaveCount(1);
        expect($params->first()->name)->toBe('parameter');
        expect($params->first()->optional)->toBeTrue();
    });

    it('handles multiple optional parameters', function () {
        $manyOptionalRoute = $this->routes->first(fn (Route $r) => str_contains($r->uri(), 'many-optional'));
        $params = $manyOptionalRoute->parameters();

        expect($params)->toHaveCount(3);
        expect($params->every(fn (RouteParameter $p) => $p->optional))->toBeTrue();
    });

    it('captures parameter placeholders', function () {
        $showRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.show');
        $param = $showRoute->parameters()->first();

        expect($param->placeholder)->toBe('{post}');
    });

    it('captures optional parameter placeholders', function () {
        $optionalRoute = $this->routes->first(fn (Route $r) => $r->name() === 'optional');
        $param = $optionalRoute->parameters()->first();

        expect($param->placeholder)->toBe('{parameter?}');
    });
});

describe('URL defaults from middleware', function () {
    it('detects URL defaults from middleware', function () {
        $defaultsRoute = $this->routes->first(
            fn (Route $r) => str_contains($r->uri(), 'with-defaults') && ! str_contains($r->uri(), 'also')
        );
        $params = $defaultsRoute->parameters();
        $localeParam = $params->first(fn (RouteParameter $p) => $p->name === 'locale');

        expect($localeParam->optional)->toBeTrue();
        expect($localeParam->default)->toBe('en');
    });

    it('handles mixed defaults and non-defaults', function () {
        $mixedRoute = $this->routes->first(fn (Route $r) => str_contains($r->uri(), 'also'));
        $params = $mixedRoute->parameters();

        $localeParam = $params->first(fn (RouteParameter $p) => $p->name === 'locale');
        $timezoneParam = $params->first(fn (RouteParameter $p) => $p->name === 'timezone');

        expect($localeParam->optional)->toBeTrue();
        expect($timezoneParam->optional)->toBeFalse();
    });
});

describe('route URIs', function () {
    it('generates correct URIs for simple routes', function () {
        $homeRoute = $this->routes->first(fn (Route $r) => $r->name() === 'home');

        expect($homeRoute->uri())->toContain('/');
    });

    it('generates correct URIs for parameter routes', function () {
        $showRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.show');

        expect($showRoute->uri())->toContain('{post}');
    });

    it('generates correct URIs for optional parameter routes', function () {
        $optionalRoute = $this->routes->first(fn (Route $r) => $r->name() === 'optional');

        expect($optionalRoute->uri())->toContain('{parameter?}');
    });
});

describe('domain routes', function () {
    it('captures fixed domain routes', function () {
        $fixedDomainRoute = $this->routes->first(fn (Route $r) => str_contains($r->uri(), 'fixed-domain'));

        expect($fixedDomainRoute->domain())->toBe('example.test');
    });

    it('captures dynamic domain routes', function () {
        $dynamicDomainRoute = $this->routes->first(fn (Route $r) => str_contains($r->uri(), 'dynamic-domain'));
        $params = $dynamicDomainRoute->parameters();

        expect($dynamicDomainRoute->domain())->toBe('{domain}.au');
        expect($params->first()->name)->toBe('domain');
    });
});

describe('route controller path', function () {
    it('returns relative path for controller routes', function () {
        $postRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.index');

        expect($postRoute->controllerPath())->toContain('PostController.php');
    });

    it('returns file path for closure routes', function () {
        $closureRoute = $this->routes->first(fn (Route $r) => $r->name() === 'home');
        $path = $closureRoute->controllerPath();

        expect($path)->toContain('.php');
    });
});

describe('explicit route key bindings', function () {
    it('detects explicit key bindings', function () {
        $editRoute = $this->routes->first(fn (Route $r) => str_contains($r->uri(), 'keys') && str_contains($r->uri(), 'edit'));
        $params = $editRoute->parameters();
        $keyParam = $params->first();

        expect($keyParam->key)->toBe('uuid');
    });

    it('uses default key when not explicitly set', function () {
        $showRoute = $this->routes->first(
            fn (Route $r) => str_contains($r->uri(), 'keys') && ! str_contains($r->uri(), 'edit')
        );
        $params = $showRoute->parameters();
        $keyParam = $params->first();

        expect($keyParam->key)->toBeNull();
    });
});

describe('controller method line numbers', function () {
    it('returns line number for controller methods', function () {
        $postRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.index');

        expect($postRoute->controllerMethodLineNumber())->toBeGreaterThan(0);
    });
});

describe('dot namespace', function () {
    it('returns dot-separated namespace for controllers', function () {
        $postRoute = $this->routes->first(fn (Route $r) => $r->name() === 'posts.index');

        expect($postRoute->dotNamespace())->toBe('App.Http.Controllers.PostController');
    });
});
