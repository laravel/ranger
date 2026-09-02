<?php

use App\Enums\Status;
use App\Enums\UserRole;
use App\Events\PostUpdated;
use App\Events\UserCreated;
use App\Models\Post;
use App\Models\User;
use App\Providers\WorkbenchServiceProvider;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\ServiceProvider;
use Laravel\Ranger\Support\Inventory;

beforeEach(function () {
    Inventory::flush();

    $this->inventory = Inventory::in($this->app->path());
});

it('finds classes extending a parent', function () {
    expect($this->inventory->classesExtending(Model::class))
        ->toContain(Post::class);
});

it('finds classes extending any of several parents', function () {
    $found = $this->inventory->classesExtending(Model::class, Authenticatable::class, ServiceProvider::class);

    expect($found)->toContain(Post::class, User::class, WorkbenchServiceProvider::class);
});

// A parent is only followed while it lives in the scanned paths. App\Models\User
// extends Authenticatable, which lives in the framework, so the chain stops
// there and asking for Model alone will not find it. This is why the model
// collector names Model, Authenticatable and Pivot rather than Model alone.
it('does not follow ancestry beyond the scanned paths', function () {
    expect($this->inventory->classesExtending(Model::class))
        ->not->toContain(User::class);

    expect($this->inventory->classesExtending(Authenticatable::class))
        ->toContain(User::class);
});

it('finds enums', function () {
    expect($this->inventory->enums())
        ->toHaveCount(8)
        ->toContain(Status::class, UserRole::class);
});

it('finds classes implementing any of several interfaces', function () {
    expect($this->inventory->classesImplementing(ShouldBroadcast::class, ShouldBroadcastNow::class))
        ->toContain(UserCreated::class, PostUpdated::class);
});

it('does not return enums when asked for classes', function () {
    expect($this->inventory->classesExtending(Model::class))
        ->not->toContain(Status::class);
});

it('does not return classes when asked for enums', function () {
    expect($this->inventory->enums())
        ->not->toContain(User::class);
});

// Conditions used to accumulate on a shared builder, so the second question
// asked was answered with the first question's conditions still attached and
// every question after the first came back empty.
it('answers each question independently of the ones before it', function () {
    $isolated = [
        'models' => Inventory::in($this->app->path())->classesExtending(Model::class),
        'enums' => Inventory::in($this->app->path())->classesExtending(ServiceProvider::class),
        'events' => Inventory::in($this->app->path())->classesImplementing(ShouldBroadcast::class),
    ];

    $sequential = [
        'models' => $this->inventory->classesExtending(Model::class),
        'enums' => $this->inventory->classesExtending(ServiceProvider::class),
        'events' => $this->inventory->classesImplementing(ShouldBroadcast::class),
    ];

    expect($sequential['models'])->toEqual($isolated['models'])->not->toBeEmpty();
    expect($sequential['enums'])->toEqual($isolated['enums'])->not->toBeEmpty();
    expect($sequential['events'])->toEqual($isolated['events'])->not->toBeEmpty();
});

it('scans the same paths once and shares the result', function () {
    $first = Inventory::in($this->app->path())->structures();
    $second = Inventory::in($this->app->path())->structures();

    expect($second)->toBe($first);
    expect($second[array_key_first($second)])->toBe($first[array_key_first($first)]);
});

it('rescans after being flushed', function () {
    $first = $this->inventory->structures();

    Inventory::flush();

    $second = Inventory::in($this->app->path())->structures();

    expect($second)->not->toBe($first);
    expect($second)->toHaveCount(count($first));
});
