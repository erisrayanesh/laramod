<?php

namespace ErisRayanesh\Laramod\Providers;

use ErisRayanesh\Laramod\Manager as ModulesManager;
use Illuminate\Support\ServiceProvider;

class LaramodServiceProvider extends ServiceProvider
{

    protected $configPath = __DIR__.DIRECTORY_SEPARATOR. '..' .DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->configPath => config_path('laramod.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
		$this->mergeConfigFrom($this->configPath, 'laramod');

		if ($this->app->runningInConsole()) {
            $this->app->register(ConsoleServiceProvider::class);
        }

        $this->app->singleton(ModulesManager::class);
        $this->app->alias(ModulesManager::class, 'modules');
    }


}
