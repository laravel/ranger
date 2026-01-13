<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Broadcast;
use Laravel\Ranger\Components\BroadcastChannel;
use Laravel\Ranger\Components\BroadcastEvent;
use Laravel\Ranger\Components\Enum;
use Laravel\Ranger\Components\Model;
use Laravel\Ranger\Components\Route;
use Laravel\Ranger\Ranger;

beforeEach(function () {
    Broadcast::channel('test.channel', fn () => true);

    $this->ranger = app(Ranger::class);
});

describe('route callbacks', function () {
    it('registers onRoute callback', function () {
        $called = false;
        $receivedRoute = null;

        $this->ranger->onRoute(function (Route $route) use (&$called, &$receivedRoute) {
            $called = true;
            $receivedRoute = $route;
        });

        $this->ranger->walk();

        expect($called)->toBeTrue();
        expect($receivedRoute)->toBeInstanceOf(Route::class);
    });

    it('calls onRoute callback for each route', function () {
        $routes = [];

        $this->ranger->onRoute(function (Route $route) use (&$routes) {
            $routes[] = $route;
        });

        $this->ranger->walk();

        expect($routes)->not->toBeEmpty();
    });

    it('registers onRoutes collection callback', function () {
        $receivedCollection = null;

        $this->ranger->onRoutes(function (Collection $routes) use (&$receivedCollection) {
            $receivedCollection = $routes;
        });

        $this->ranger->walk();

        expect($receivedCollection)->toBeInstanceOf(Collection::class);
        expect($receivedCollection)->not->toBeEmpty();
    });
});

describe('model callbacks', function () {
    it('registers onModel callback', function () {
        $called = false;
        $receivedModel = null;

        $this->ranger->onModel(function (Model $model) use (&$called, &$receivedModel) {
            $called = true;
            $receivedModel = $model;
        });

        $this->ranger->walk();

        expect($called)->toBeTrue();
        expect($receivedModel)->toBeInstanceOf(Model::class);
    });

    it('calls onModel callback for each model', function () {
        $models = [];

        $this->ranger->onModel(function (Model $model) use (&$models) {
            $models[] = $model;
        });

        $this->ranger->walk();

        expect($models)->not->toBeEmpty();
    });

    it('registers onModels collection callback', function () {
        $receivedCollection = null;

        $this->ranger->onModels(function (Collection $models) use (&$receivedCollection) {
            $receivedCollection = $models;
        });

        $this->ranger->walk();

        expect($receivedCollection)->toBeInstanceOf(Collection::class);
    });
});

describe('enum callbacks', function () {
    it('registers onEnum callback', function () {
        $called = false;
        $receivedEnum = null;

        $this->ranger->onEnum(function (Enum $enum) use (&$called, &$receivedEnum) {
            $called = true;
            $receivedEnum = $enum;
        });

        $this->ranger->walk();

        expect($called)->toBeTrue();
        expect($receivedEnum)->toBeInstanceOf(Enum::class);
    });

    it('calls onEnum callback for each enum', function () {
        $enums = [];

        $this->ranger->onEnum(function (Enum $enum) use (&$enums) {
            $enums[] = $enum;
        });

        $this->ranger->walk();

        expect($enums)->toHaveCount(4);
    });

    it('registers onEnums collection callback', function () {
        $receivedCollection = null;

        $this->ranger->onEnums(function (Collection $enums) use (&$receivedCollection) {
            $receivedCollection = $enums;
        });

        $this->ranger->walk();

        expect($receivedCollection)->toBeInstanceOf(Collection::class);
        expect($receivedCollection)->toHaveCount(4);
    });
});

describe('broadcast event callbacks', function () {
    it('registers onBroadcastEvent callback', function () {
        $called = false;
        $receivedEvent = null;

        $this->ranger->onBroadcastEvent(function (BroadcastEvent $event) use (&$called, &$receivedEvent) {
            $called = true;
            $receivedEvent = $event;
        });

        $this->ranger->walk();

        expect($called)->toBeTrue();
        expect($receivedEvent)->toBeInstanceOf(BroadcastEvent::class);
    });

    it('registers onBroadcastEvents collection callback', function () {
        $receivedCollection = null;

        $this->ranger->onBroadcastEvents(function (Collection $events) use (&$receivedCollection) {
            $receivedCollection = $events;
        });

        $this->ranger->walk();

        expect($receivedCollection)->toBeInstanceOf(Collection::class);
    });
});

describe('broadcast channel callbacks', function () {
    it('registers onBroadcastChannel callback', function () {
        $called = false;
        $receivedChannel = null;

        $this->ranger->onBroadcastChannel(function (BroadcastChannel $channel) use (&$called, &$receivedChannel) {
            $called = true;
            $receivedChannel = $channel;
        });

        $this->ranger->walk();

        expect($called)->toBeTrue();
        expect($receivedChannel)->toBeInstanceOf(BroadcastChannel::class);
    });

    it('registers onBroadcastChannels collection callback', function () {
        $receivedCollection = null;

        $this->ranger->onBroadcastChannels(function (Collection $channels) use (&$receivedCollection) {
            $receivedCollection = $channels;
        });

        $this->ranger->walk();

        expect($receivedCollection)->toBeInstanceOf(Collection::class);
    });
});

describe('multiple callbacks', function () {
    it('supports multiple callbacks for the same type', function () {
        $callCount = 0;

        $this->ranger->onEnum(function () use (&$callCount) {
            $callCount++;
        });

        $this->ranger->onEnum(function () use (&$callCount) {
            $callCount++;
        });

        $this->ranger->walk();

        expect($callCount)->toBe(8);
    });

    it('supports callbacks for different types', function () {
        $enumCount = 0;
        $modelCount = 0;
        $routeCount = 0;

        $this->ranger->onEnum(function () use (&$enumCount) {
            $enumCount++;
        });

        $this->ranger->onModel(function () use (&$modelCount) {
            $modelCount++;
        });

        $this->ranger->onRoute(function () use (&$routeCount) {
            $routeCount++;
        });

        $this->ranger->walk();

        expect($enumCount)->toBeGreaterThan(0);
        expect($modelCount)->toBeGreaterThan(0);
        expect($routeCount)->toBeGreaterThan(0);
    });
});
