<?php

use App\Enums\NumericEnum;
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

    expect($enums)->toHaveCount(4);
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
