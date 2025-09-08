<?php

namespace ErisRayanesh\Laramod\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

abstract class BaseModuleServiceProvider extends ServiceProvider
{

    /**
     * Module name in lowercase
     * @var string $moduleName
     */
    protected string $moduleName;

    /**
     * Module base path
     * @var string
     */
    protected string $basePath;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->resolveBasePath();
        $this->booting(function() {
            $this->publishResources();
            $this->registerModule();
            $this->registerResources();
        });
    }

    private function resolveName(): string
    {
        $className = class_basename(static::class);

        if (Str::contains($className, 'ServiceProvider')) {
            return Str::kebab(Str::replace('ServiceProvider', '', $className));
        }

        return '';
    }

    protected function getModuleName(): string
    {
        return $this->moduleName ??= $this->resolveName();
    }

    protected function registerModule()
    {
        //$this->app['modules']->register($this->getModuleName(), $this->modulePath());
    }

    protected function publishResources()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        if (method_exists($this, 'publishConfig')) {
            $this->publishConfig();
        }

        if (method_exists($this, 'publishAssets')) {
            $this->publishAssets();
        }

        if (method_exists($this, 'publishViews')) {
            $this->publishViews();
        }

        if (method_exists($this, 'publishBladeComponents')) {
            $this->publishBladeComponents();
        }

        if (method_exists($this, 'publishTranslations')) {
            $this->publishTranslations();
        }

        if (method_exists($this, 'publishFactories')) {
            $this->publishFactories();
        }

        if (method_exists($this, 'publishMigrations')) {
            $this->publishMigrations();
        }

        if (method_exists($this, 'publishSeeders')) {
            $this->publishSeeders();
        }
    }

    protected function registerResources()
    {

        if (method_exists($this, 'registerEvents')) {
            $this->registerEvents();
        }

        if (method_exists($this, 'registerRoutes')) {
            $this->registerRoutes();
        }

        if (method_exists($this, 'registerViews')) {
            $this->registerViews();
        }

        if (method_exists($this, 'registerBladeComponents')) {
            $this->registerBladeComponents();
        }

        if (method_exists($this, 'registerTranslations')) {
            $this->registerTranslations();
        }

        //
        if (!$this->app->runningInConsole()) {
            return;
        }

        if (method_exists($this, 'registerMigrations')) {
            $this->registerMigrations();
        }
    }

    protected function modulePath($path=null): string
    {
        return realpath($this->basePath) . (empty($path)? '' : DIRECTORY_SEPARATOR.$path);
    }

    protected function resolveBasePath()
    {
        $this->basePath = $this->basePath ?? dirname((new \ReflectionClass(static::class))->getFileName());
    }

    public function register()
    {
        if (method_exists($this, 'mergeConfig')) {
            $this->mergeConfig();
        }


    }
}
