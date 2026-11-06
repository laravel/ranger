<?php

use App\Enums\ConditionalEnum;
use App\Enums\IgnoredEnum;
use App\Enums\NumericEnum;
use App\Enums\PartiallyIgnoredEnum;
use App\Enums\Status;
use App\Enums\UnitEnum;
use App\Enums\UserRole;
use Laravel\Ranger\Collectors\Enums;
use Laravel\Ranger\Components\Enum;

beforeEach(function () {
    $this->collector = app(Enums::class);
});

it('collects all enums from the application', function () {
    $enums = $this->collector->collect();

    expect($enums)->toHaveCount(7);
    expect($enums->pluck('name')->toArray())->toContain(Status::class, UserRole::class);
});

it('creates enum components with correct name', function () {
    $enums = $this->collector->collect();

    $status = $enums->first(fn (Enum $e) => $e->name === Status::class);
    $userRole = $enums->first(fn (Enum $e) => $e->name === UserRole::class);

    expect($status)->toBeInstanceOf(Enum::class);
    expect($userRole)->toBeInstanceOf(Enum::class);
});

it('captures all enum cases correctly', function () {
    $enums = $this->collector->collect();

    $status = $enums->first(fn (Enum $e) => $e->name === Status::class);

    expect($status->cases)->toHaveCount(7);
    expect($status->cases)->toMatchArray([
        'ACTIVE' => 'active',
        'INACTIVE' => 'inactive',
        'PENDING' => 'pending',
        'SUSPENDED' => 'suspended',
        'DRAFT' => 'draft',
        'PUBLISHED' => 'published',
        'ARCHIVED' => 'archived',
    ]);
});

it('captures user role enum cases correctly', function () {
    $enums = $this->collector->collect();

    $userRole = $enums->first(fn (Enum $e) => $e->name === UserRole::class);

    expect($userRole->cases)->toHaveCount(6);
    expect($userRole->cases)->toMatchArray([
        'ADMIN' => 'admin',
        'MODERATOR' => 'moderator',
        'USER' => 'user',
        'GUEST' => 'guest',
        'EDITOR' => 'editor',
        'VIEWER' => 'viewer',
    ]);
});

it('captures numeric enum cases correctly', function () {
    $enums = $this->collector->collect();

    $userRole = $enums->first(fn (Enum $e) => $e->name === NumericEnum::class);

    expect($userRole->cases)->toHaveCount(2);
    expect($userRole->cases)->toMatchArray([
        'ONE' => 1,
        'TWO' => 2,
    ]);
});

it('captures unit enum cases correctly', function () {
    $enums = $this->collector->collect();

    $userRole = $enums->first(fn (Enum $e) => $e->name === UnitEnum::class);

    expect($userRole->cases)->toHaveCount(2);
    expect($userRole->cases)->toMatchArray([
        'BAR' => 0,
        'FOO' => 1,
    ]);
});

it('sets the file path on enum components', function () {
    $enums = $this->collector->collect();

    $status = $enums->first(fn (Enum $e) => $e->name === Status::class);

    expect($status->filePath())->toContain('Status.php');
});

it('caches collection results', function () {
    $firstCall = $this->collector->getCollection();
    $secondCall = $this->collector->getCollection();

    expect($firstCall)->toBe($secondCall);
});

it('gets an enum outside the configured application paths', function (string $enum, array $cases) {
    $this->collector->setAppPaths(app_path('Models'));
    expect($this->collector->getCollection())->toBeEmpty();

    $component = $this->collector->get($enum);

    expect($component->name)->toBe($enum);
    expect($component->cases)->toBe($cases);
    expect($component->filePath())->toBe(realpath(app_path('Enums/'.class_basename($enum).'.php')));
})->with([
    'integer backed enum' => [NumericEnum::class, ['ONE' => 1, 'TWO' => 2]],
    'unit enum' => [UnitEnum::class, ['BAR' => 0, 'FOO' => 1]],
    'string backed enum with an ignored case' => [PartiallyIgnoredEnum::class, [
        'PUBLIC_CASE' => 'public',
        'OTHER_CASE' => 'other',
    ]],
]);

it('does not get an ignored enum', function () {
    expect($this->collector->get(IgnoredEnum::class))->toBeNull();
});

it('resolves conditional ignore markers when getting an enum', function (array $config, array $cases) {
    config($config);

    expect($this->collector->get(ConditionalEnum::class)->cases)->toBe($cases);
})->with([
    'hidden cases' => [[
        'features.fake' => false,
        'features.fake_callable' => false,
        'features.hide_retired' => true,
    ], ['REAL' => 'real']],
    'visible cases' => [[
        'features.fake' => true,
        'features.fake_callable' => true,
        'features.hide_retired' => false,
    ], [
        'REAL' => 'real',
        'FAKE' => 'fake',
        'CALLABLE_FAKE' => 'callable-fake',
        'RETIRED' => 'retired',
    ]],
]);
