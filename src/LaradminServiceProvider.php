<?php

namespace Akhilesh\Laradmin;

use Illuminate\Support\ServiceProvider;
use Akhilesh\Laradmin\Console\InstallLaradminCommand;
use Akhilesh\Laradmin\Http\Middleware\EnsureRole;
use Akhilesh\Laradmin\Http\Middleware\MustChangePassword;

class LaradminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laradmin.php', 'laradmin');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laradmin');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    
        if ($this->app->runningInConsole()) {
    
            // Publish config
            $this->publishes([
                __DIR__.'/../config/laradmin.php' => config_path('laradmin.php'),
            ], 'laradmin-config');
    
            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laradmin'),
            ], 'laradmin-views');
    
            // Publish public assets
            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/laradmin'),
            ], 'laradmin-assets');
    
            // Register CLI command
            $this->commands([InstallLaradminCommand::class]);
        }
    
        // Middleware aliases
        $router = $this->app['router'];
        $router->aliasMiddleware('role', EnsureRole::class);
        $router->aliasMiddleware('must.change.password', MustChangePassword::class);
    }

}
