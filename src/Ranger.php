<?php

namespace Laravel\Ranger;

use Illuminate\Support\Collection;
use Laravel\Ranger\Collectors\Collector;
use Laravel\Ranger\Components\BroadcastChannel;
use Laravel\Ranger\Components\BroadcastEvent;
use Laravel\Ranger\Components\Enum;
use Laravel\Ranger\Components\EnvironmentVariable;
use Laravel\Ranger\Components\InertiaSharedData;
use Laravel\Ranger\Components\Model;
use Laravel\Ranger\Components\Route;
use Laravel\Ranger\Support\HasPaths;

class Ranger
{
    use HasPaths;

    /**
     * @var array<class-string<Collector>, callable[]>
     */
    protected array $callbacks = [];

    /**
     * @var array<class-string<Collector>, callable[]>
     */
    protected array $collectionCallbacks = [];

    /**
     * Register a callback to be called when a route is found.
     *
     * @param  callable(Route): void  $callback
     */
    public function onRoute(callable $callback): void
    {
        $this->addCallback(Collectors\Routes::class, $callback);
    }

    /**
     * Register a callback to be called when the entire collection of routes is found.
     *
     * @param  callable(Collection<Route>): void  $callback
     */
    public function onRoutes(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\Routes::class, $callback);
    }

    /**
     * Register a callback to be called when a model is found.
     *
     * @param  callable(Model): void  $callback
     */
    public function onModel(callable $callback): void
    {
        $this->addCallback(Collectors\Models::class, $callback);
    }

    /**
     * Register a callback to be called when the entire collection of models is found.
     *
     * @param  callable(Collection<Model>): void  $callback
     */
    public function onModels(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\Models::class, $callback);
    }

    /**
     * Register a callback to be called when an enum is found.
     *
     * @param  callable(Enum): void  $callback
     */
    public function onEnum(callable $callback): void
    {
        $this->addCallback(Collectors\Enums::class, $callback);
    }

    /**
     * Register a callback to be called when the entire collection of enums is found.
     *
     * @param  callable(Collection<Enum>): void  $callback
     */
    public function onEnums(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\Enums::class, $callback);
    }

    /**
     * Register a callback to be called when a broadcast event is found.
     *
     * @param  callable(BroadcastEvent): void  $callback
     */
    public function onBroadcastEvent(callable $callback): void
    {
        $this->addCallback(Collectors\BroadcastEvents::class, $callback);
    }

    /**
     * Register a callback to be called when inertia shared data is found.
     *
     * @param  callable(InertiaSharedData): void  $callback
     */
    public function onInertiaSharedData(callable $callback): void
    {
        $this->addCallback(Collectors\InertiaSharedData::class, $callback);
    }

    /**
     * Register a callback to be called when the entire collection of broadcast events is found.
     *
     * @param  callable(Collection<BroadcastEvent>): void  $callback
     */
    public function onBroadcastEvents(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\BroadcastEvents::class, $callback);
    }

    /**
     * Register a callback to be called when a broadcast channel is found.
     *
     * @param  callable(BroadcastChannel): void  $callback
     */
    public function onBroadcastChannel(callable $callback): void
    {
        $this->addCallback(Collectors\BroadcastChannels::class, $callback);
    }

    /**
     * Register a callback to be called when the entire collection of broadcast channels is found.
     *
     * @param  callable(Collection<BroadcastChannel>): void  $callback
     */
    public function onBroadcastChannels(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\BroadcastChannels::class, $callback);
    }

    /**
     * Register a callback to be called when an environment variable is found.
     *
     * @param  callable(EnvironmentVariable): void  $callback
     */
    public function onEnvironmentVariable(callable $callback): void
    {
        $this->addCallback(Collectors\EnvironmentVariables::class, $callback);
    }

    /**
     * Register a callback to be called when the entire collection of environment variables is found.
     *
     * @param  callable(Collection<EnvironmentVariable>): void  $callback
     */
    public function onEnvironmentVariables(callable $callback): void
    {
        $this->addCollectionCallback(Collectors\EnvironmentVariables::class, $callback);
    }

    /**
     * Walk the collectors and run the registered callbacks.
     */
    public function walk(): void
    {
        foreach ($this->callbacks as $collector => $callbacks) {
            app($collector)
                ->setBasePaths(...$this->basePaths)
                ->setAppPaths(...$this->appPaths)
                ->run($callbacks);
        }

        foreach ($this->collectionCallbacks as $collector => $callbacks) {
            app($collector)
                ->setBasePaths(...$this->basePaths)
                ->setAppPaths(...$this->appPaths)
                ->runOnCollection($callbacks);
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
