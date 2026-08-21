<?php

namespace Laravel\Ranger;

use Illuminate\Support\ServiceProvider;
use Laravel\Ranger\Collectors\BroadcastChannels;
use Laravel\Ranger\Collectors\BroadcastEvents;
use Laravel\Ranger\Collectors\Enums;
use Laravel\Ranger\Collectors\Models;
use Laravel\Ranger\Collectors\Routes;
use Laravel\Ranger\Support\Ignores;
use Laravel\Surveyor\Support\Markers;

class RangerServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->app->singleton(Enums::class);
        $this->app->singleton(Models::class);
        $this->app->singleton(Routes::class);
        $this->app->singleton(BroadcastChannels::class);
        $this->app->singleton(BroadcastEvents::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->registerPublishing();

        Markers::registerConditionResolver([Ignores::class, 'evaluate']);
    }

    /**
     * Register the package's publishable resources.
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ranger.php' => config_path('ranger.php'),
            ], 'ranger-config');
        }
    }
}
