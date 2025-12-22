<?php

use Laravel\Ranger\Collectors\Collector;
use Laravel\Ranger\Ranger;
use Laravel\Ranger\Tests\TestCase;

pest()
    ->extend(TestCase::class)
    ->in('Feature', 'Unit')
    ->beforeEach(function () {
        $this->app->resolving(Ranger::class, function (Ranger $ranger) {
            $ranger->setAppPaths($this->app->path());
            $ranger->setBasePaths($this->app->basePath());
        });

        $this->app->resolving(Collector::class, function (Collector $collector) {
            $collector->setAppPaths($this->app->path());
            $collector->setBasePaths($this->app->basePath());
        });
    });
