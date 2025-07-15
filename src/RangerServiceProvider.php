<?php

namespace Laravel\Ranger;

// TODO: Temp fix, gotta figure this out...
ini_set('memory_limit', '256M');

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Laravel\Ranger\Collectors\BroadcastChannels;
use Laravel\Ranger\Collectors\BroadcastEvents;
use Laravel\Ranger\Collectors\Enums;
use Laravel\Ranger\Collectors\Models;
use Laravel\Ranger\Collectors\Routes;
use Laravel\Ranger\Util\DocBlockParser;
use Laravel\Ranger\Util\DocBlockTypeResolver;
use Laravel\Ranger\Util\Parser;
use Phar;
use PhpParser\PrettyPrinter\Standard;
use PHPStan\Analyser\ScopeFactory;
use PHPStan\DependencyInjection\ContainerFactory;

use function Orchestra\Testbench\workbench_path;

class RangerServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(Enums::class);
        $this->app->singleton(Models::class);
        $this->app->singleton(Routes::class);
        $this->app->singleton(BroadcastChannels::class);
        $this->app->singleton(BroadcastEvents::class);

        // TODO: Make this configurable
        // if (app()->environment('testing')) {
        //     app()->setBasePath('workbench');
        //     $this->loadMigrationsFrom(
        //         workbench_path('database/migrations')
        //     );
        // }

        // $this->mergeConfigFrom(
        //     __DIR__ . '/../config/ranger.php',
        //     'ranger'
        // );

        // if ($this->app->runningInConsole()) {
        //     $pharPath = __DIR__ . '/../vendor/phpstan/phpstan/phpstan.phar';

        //     if (! file_exists($pharPath)) {
        //         exit("PHPStan phar not found at: $pharPath\n");
        //     }

        //     Phar::loadPhar($pharPath, 'phpstan.phar');
        //     require_once 'phar://phpstan.phar/vendor/autoload.php';

        //     $tmpDir = __DIR__ . '/../../tmp';

        //     File::ensureDirectoryExists($tmpDir);

        //     $this->app->singleton(DocBlockParser::class, function ($app) {
        //         return new DocBlockParser($this->app->make(DocBlockTypeResolver::class));
        //     });

        //     $this->app->singleton(ScopeFactory::class, function ($app) {
        //         $tmpDir = __DIR__ . '/../../tmp';
        //         $containerFactory = new ContainerFactory($tmpDir);
        //         $container = $containerFactory->create($tmpDir, [], []);
        //         $scopeFactory = $container->getByType(ScopeFactory::class);

        //         return $scopeFactory;
        //     });

        //     $this->app->singleton(Parser::class, function ($app) {
        //         return new Parser(new Standard);
        //     });
        // }
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPublishing();
        // $this->registerCommands();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ranger.php' => config_path('ranger.php'),
            ], 'ranger-config');
        }
    }

    /**
     * Register the package's commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\GenerateCommand::class,
                Console\ScaffoldResolversCommand::class,
                Console\ScaffoldDocBlockResolversCommand::class,
                Console\ScaffoldPhpStanTypesCommand::class,
            ]);
        }
    }
}
