<?php

namespace Netmask\CautivePortal;

use Illuminate\Support\ServiceProvider;

class CautivePortalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->make('Netmask\CautivePortal\Controllers\CautivePortalController');

        $this->loadHelpers();

        if ($this->app->runningInConsole()) {
            $this->commands(Commands\InstallCommand::class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //$this->loadRoutesFrom(__DIR__ . '/../routes/cautiveportal.php');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'cautiveportal');

        $this->publishes([
            __DIR__ . '/../publishable/Models' => base_path('app'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/Widgets' => base_path('app/Widgets'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/Exports' => base_path('app/Exports'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/Controllers' => base_path('app/Http/Controllers'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/resources/lang' => base_path('resources/lang'),
        ]);

        /*$this->publishes([
            __DIR__ . '/../publishable/database' => base_path('database'),
        ]);*/

        $this->publishes([
            __DIR__ . '/../publishable/resources/views' => base_path('resources/views/vendor/cautiveportal'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/resources/assets/js' => base_path('resources/js'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/resources/assets/sass' => base_path('resources/sass'),
        ]);

        $this->publishes([
            __DIR__ . '/../publishable/resources/assets/images' => base_path('resources/images'),
        ]);
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
