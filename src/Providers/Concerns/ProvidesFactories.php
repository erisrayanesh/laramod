<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


trait ProvidesFactories
{

    /**
    * publishes factories
    */
    protected function publishFactories()
    {
        if ($this->app->environment('production') || !$this->app->runningInConsole()) {
            return;
        }

        $sourcePath = $this->modulePath($this->getFactoriesPath());
        $factories = database_path('factories' . DIRECTORY_SEPARATOR . $this->getModuleName());
        $this->publishes([$sourcePath => $factories], ['factories', $this->getModuleName() . '-module-factories']);
    }

    protected function getFactoriesPath()
    {
        return 'database' . DIRECTORY_SEPARATOR . 'factories';
    }
}
