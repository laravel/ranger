<?php

namespace Laravel\Ranger;

use Laravel\Ranger\Collectors\Collector;

class Ranger
{
    protected array $callbacks = [];

    protected array $collectionCallbacks = [];

    public function onRoute(callable $callback): void
    {
        $this->addCallback(Collectors\Routes::class, $callback);
    }

    public function onRoutes(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\Routes::class, $callback);
    }

    public function onModel(callable $callback): void
    {
        $this->addCallback(Collectors\Models::class, $callback);
    }

    public function onModels(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\Models::class, $callback);
    }

    public function onEnum(callable $callback): void
    {
        $this->addCallback(Collectors\Enums::class, $callback);
    }

    public function onEnums(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\Enums::class, $callback);
    }

    public function onBroadcastEvent(callable $callback): void
    {
        $this->addCallback(Collectors\BroadcastEvents::class, $callback);
    }

    public function onBroadcastEvents(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\BroadcastEvents::class, $callback);
    }

    public function onBroadcastChannel(callable $callback): void
    {
        $this->addCallback(Collectors\BroadcastChannels::class, $callback);
    }

    public function onBroadcastChannels(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\BroadcastChannels::class, $callback);
    }

    // TODO: Is this just part of routes? Or is it a separate thing?
    // public function onFormRequest(callable $callback): void
    // {
    //     $this->addCallback(Collectors\FormRequests::class, $callback);
    // }

    public function walk()
    {
        foreach ($this->callbacks as $collector => $callbacks) {
            app($collector)->run($callbacks);
        }

        foreach ($this->collectionCallbacks as $collector => $callbacks) {
            app($collector)->runOnCollection($callbacks);
        }
    }

    /**
     * @param  class-string<Collector>  $type
     */
    protected function addCallback(string $type, callable $callback): void
    {
        $this->callbacks[$type] ??= [];
        $this->callbacks[$type][] = $callback;
    }

    /**
     * @param  class-string<Collector>  $type
     */
    protected function addCollectionCallback(string $type, callable $callback): void
    {
        $this->collectionCallbacks[$type] ??= [];
        $this->collectionCallbacks[$type][] = $callback;
    }
}
