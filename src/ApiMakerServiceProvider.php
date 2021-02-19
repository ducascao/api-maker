<?php

namespace Ducascao\ApiMaker;

use Ducascao\ApiMaker\Commands\BaseInterfaceMakeCommand;
use Ducascao\ApiMaker\Commands\BaseRepositoryInterfaceMakeCommand;
use Ducascao\ApiMaker\Commands\BaseServiceMakeCommand;
use Ducascao\ApiMaker\Commands\ControllerServiceMakeCommand;
use Ducascao\ApiMaker\Commands\FacadeMakeCommand;
use Ducascao\ApiMaker\Commands\RepositoryInterfaceMakeCommand;
use Ducascao\ApiMaker\Commands\RepositoryMakeCommand;
use Ducascao\ApiMaker\Commands\ServiceInterfaceMakeCommand;
use Ducascao\ApiMaker\Commands\ServiceMakeCommand;
use Ducascao\ApiMaker\Commands\BaseRepositoryMakeCommand;
use Ducascao\ApiMaker\Build\MidwayService;
use Ducascao\ApiMaker\Build\ProjectService;
use Ducascao\ApiMaker\Build\ModelService;
use Ducascao\ApiMaker\Build\ControllerService;
use Ducascao\ApiMaker\Build\MigrationService;
use Ducascao\ApiMaker\Build\ProviderService;
use Ducascao\ApiMaker\Build\CommonService;
use Ducascao\ApiMaker\Build\RouteService;
use Ducascao\ApiMaker\Commands\ProviderServiceMakeCommand;
use Ducascao\ApiMaker\Commands\StubsPublishCommand;
use Ducascao\ApiMaker\Interfaces\ControllerServiceInterface;
use Ducascao\ApiMaker\Interfaces\MidwayServiceInterface;
use Ducascao\ApiMaker\Interfaces\MigrationServiceInterface;
use Ducascao\ApiMaker\Interfaces\ModelServiceInterface;
use Ducascao\ApiMaker\Interfaces\ProjectServiceInterface;
use Ducascao\ApiMaker\Interfaces\ProviderServiceInterface;
use Ducascao\ApiMaker\Interfaces\CommonServiceInterface;
use Ducascao\ApiMaker\Interfaces\RouteServiceInterface;
use Illuminate\Support\ServiceProvider;

class ApiMakerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ducascao');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'ducascao');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // Registering package commands.
        $this->commands([
            BaseRepositoryMakeCommand::class,
            ServiceMakeCommand::class,
            FacadeMakeCommand::class,
            ServiceInterfaceMakeCommand::class,
            RepositoryMakeCommand::class,
            RepositoryInterfaceMakeCommand::class,
            ControllerServiceMakeCommand::class,
            BaseInterfaceMakeCommand::class,
            BaseServiceMakeCommand::class,
            BaseRepositoryInterfaceMakeCommand::class,
            ProviderServiceMakeCommand::class
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/api-maker.php', 'api-maker');

        // Register the service the package provides.
        $this->app->singleton('api-maker', function ($app) {
            return new ApiMaker;
        });

        $this->app->bind(MigrationServiceInterface::class, MigrationService::class);
        $this->app->bind(ModelServiceInterface::class, ModelService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(MidwayServiceInterface::class, MidwayService::class);
        $this->app->bind(ControllerServiceInterface::class, ControllerService::class);
        $this->app->bind(RouteServiceInterface::class, RouteService::class);
        $this->app->bind(ProviderServiceInterface::class, ProviderService::class);
        $this->app->bind(CommonServiceInterface::class, CommonService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['api-maker'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/api-maker.php' => config_path('api-maker.php'),
        ], 'api-maker.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ducascao'),
        ], 'api-maker.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ducascao'),
        ], 'api-maker.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ducascao'),
        ], 'api-maker.views');*/

        // Registering package commands.
        $this->commands([
            StubsPublishCommand::class,
        ]);
    }
}
