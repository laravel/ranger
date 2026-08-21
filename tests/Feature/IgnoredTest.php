<?php

use App\Enums\ConditionalEnum;
use App\Enums\IgnoredEnum;
use App\Enums\PartiallyIgnoredEnum;
use App\Events\IgnoredEvent;
use App\Events\MarkedBroadcastWithEvent;
use App\Http\Controllers\IgnoredController;
use App\Http\Controllers\PartiallyIgnoredController;
use App\Models\Post;
use App\Models\SecretModel;
use App\Models\Vault;
use Illuminate\Support\Facades\Route as RouteFacade;
use Laravel\Ranger\Collectors\BroadcastEvents;
use Laravel\Ranger\Collectors\Enums;
use Laravel\Ranger\Collectors\InertiaSharedData;
use Laravel\Ranger\Collectors\Models;
use Laravel\Ranger\Collectors\Routes;
use Laravel\Ranger\Components\Enum;
use Laravel\Ranger\Components\Model;
use Laravel\Ranger\Components\Route;

describe('routes', function () {
    it('drops routes handled by a marked controller', function () {
        RouteFacade::get('ignored-controller', [IgnoredController::class, 'index'])->name('ignored.index');

        $routes = app(Routes::class)->collect();

        expect($routes->first(fn (Route $route) => $route->name() === 'ignored.index'))->toBeNull();
    });

    it('drops routes handled by a marked method but keeps its siblings', function () {
        RouteFacade::get('partially-ignored/keep', [PartiallyIgnoredController::class, 'keep'])->name('partial.keep');
        RouteFacade::get('partially-ignored/hidden', [PartiallyIgnoredController::class, 'hidden'])->name('partial.hidden');

        $routes = app(Routes::class)->collect();

        expect($routes->first(fn (Route $route) => $route->name() === 'partial.keep'))->not->toBeNull();
        expect($routes->first(fn (Route $route) => $route->name() === 'partial.hidden'))->toBeNull();
    });
});

describe('enums', function () {
    it('drops a marked enum', function () {
        $enums = app(Enums::class)->collect();

        expect($enums->first(fn (Enum $enum) => $enum->name === IgnoredEnum::class))->toBeNull();
    });

    it('drops a marked case and keeps the position of the rest', function () {
        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === PartiallyIgnoredEnum::class);

        expect($enum->cases)->toBe([
            'PUBLIC_CASE' => 'public',
            'OTHER_CASE' => 'other',
        ]);
    });
});

describe('models', function () {
    it('carries a marker from an accessor defined in a trait', function () {
        $post = app(Models::class)->collect()
            ->first(fn (Model $model) => $model->name === Post::class);

        expect(array_keys($post->getAttributes()))->toContain('public_note');
        expect(array_keys($post->getAttributes()))->not->toContain('secret_note');
    });

    it('drops a marked model', function () {
        $models = app(Models::class)->collect();

        expect($models->first(fn (Model $model) => $model->name === SecretModel::class))->toBeNull();
    });

    it('drops a relation pointing at a marked model', function () {
        $vault = app(Models::class)->collect()
            ->first(fn (Model $model) => $model->name === Vault::class);

        expect($vault)->not->toBeNull();
        expect($vault->getRelations())->toBe([]);
    });
});

describe('reading a member by name', function () {
    it('falls back when the method a collector reads is marked', function () {
        $event = app(BroadcastEvents::class)->collect()
            ->first(fn ($event) => $event->className === MarkedBroadcastWithEvent::class);

        expect($event)->not->toBeNull();
        expect(array_keys($event->data->value))->toBe(['keptProperty']);
    });

    it('shares nothing when a marked share method is all there is', function () {
        $shared = app(InertiaSharedData::class)->collect();

        expect($shared)->toHaveCount(3);
        expect($shared->filter(fn ($data) => $data->data->value === [])->count())
            ->toBeGreaterThan(0);
    });
});

describe('broadcast events', function () {
    it('drops a marked event', function () {
        $events = app(BroadcastEvents::class)->collect();

        expect($events->pluck('name')->all())->not->toContain(IgnoredEvent::class);
    });
});

describe('conditional markers', function () {
    it('keeps a case while its config key is on', function () {
        config(['features.fake' => true]);

        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->toContain('FAKE');
    });

    it('drops a case when its config key is off', function () {
        config(['features.fake' => false]);

        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->not->toContain('FAKE');
    });

    it('drops a case when its config key is missing', function () {
        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->toBe(['REAL', 'RETIRED']);
    });

    it('drops a case while its when condition passes', function () {
        config(['features.hide_retired' => true]);

        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->not->toContain('RETIRED');
    });

    it('keeps a case while its when condition fails', function () {
        config(['features.hide_retired' => false]);

        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->toContain('RETIRED');
    });

    it('keeps a case whose when condition key is missing', function () {
        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->toContain('RETIRED');
    });

    it('keeps a case while its callable condition passes', function () {
        config(['features.fake_callable' => true]);

        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->toContain('CALLABLE_FAKE');
    });

    it('drops a case when its callable condition fails', function () {
        config(['features.fake_callable' => false]);

        $enum = app(Enums::class)->collect()
            ->first(fn (Enum $enum) => $enum->name === ConditionalEnum::class);

        expect(array_keys($enum->cases))->not->toContain('CALLABLE_FAKE');
    });
});
