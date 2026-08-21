<?php

use App\Events\PostCreated;
use App\Events\PostUpdated;
use App\Events\UserCreated;
use App\Events\UserUpdated;
use Laravel\Ranger\Collectors\BroadcastEvents;
use Laravel\Ranger\Components\BroadcastEvent;

beforeEach(function () {
    $this->collector = app(BroadcastEvents::class);
});

describe('broadcast event collection', function () {
    it('collects broadcast events from the application', function () {
        $events = $this->collector->collect();

        expect($events)->not->toBeEmpty();
        expect($events)->toHaveCount(5);
    });

    it('finds UserCreated event', function () {
        $events = $this->collector->collect();
        $userCreated = $events->first(fn (BroadcastEvent $e) => $e->className === UserCreated::class);

        expect($userCreated)->not->toBeNull();
        expect($userCreated)->toBeInstanceOf(BroadcastEvent::class);
    });

    it('finds PostUpdated event (implementing ShouldBroadcastNow)', function () {
        $events = $this->collector->collect();
        $postUpdated = $events->first(fn (BroadcastEvent $e) => $e->className === PostUpdated::class);

        expect($postUpdated)->not->toBeNull();
        expect($postUpdated)->toBeInstanceOf(BroadcastEvent::class);
    });

    it('finds UserUpdated event', function () {
        $events = $this->collector->collect();
        $userUpdated = $events->first(fn (BroadcastEvent $e) => $e->className === UserUpdated::class);

        expect($userUpdated)->not->toBeNull();
    });

    it('finds PostCreated event', function () {
        $events = $this->collector->collect();
        $postCreated = $events->first(fn (BroadcastEvent $e) => $e->className === PostCreated::class);

        expect($postCreated)->not->toBeNull();
    });

    it('caches collection results', function () {
        $firstCall = $this->collector->getCollection();
        $secondCall = $this->collector->getCollection();

        expect($firstCall)->toBe($secondCall);
    });
});

describe('broadcast event names', function () {
    it('uses class name as default event name', function () {
        $events = $this->collector->collect();
        $userCreated = $events->first(fn (BroadcastEvent $e) => $e->className === UserCreated::class);

        expect($userCreated->name)->toBe(UserCreated::class);
    });
});

describe('broadcast event data', function () {
    it('captures broadcastWith data', function () {
        $events = $this->collector->collect();
        $userCreated = $events->first(fn (BroadcastEvent $e) => $e->className === UserCreated::class);

        expect($userCreated->data)->not->toBeNull();
    });

    it('captures PostCreated broadcastWith data structure', function () {
        $events = $this->collector->collect();
        $postCreated = $events->first(fn (BroadcastEvent $e) => $e->className === PostCreated::class);

        expect($postCreated->data)->not->toBeNull();
    });
});

describe('broadcast event file path', function () {
    it('sets file path on broadcast events', function () {
        $events = $this->collector->collect();
        $userCreated = $events->first(fn (BroadcastEvent $e) => $e->className === UserCreated::class);

        expect($userCreated->filePath())->toContain('UserCreated.php');
    });
});
