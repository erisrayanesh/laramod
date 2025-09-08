<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


trait ProvidesConfig
{

    protected function publishConfig()
    {
        $this->publishes([
            $this->modulePath($this->getConfigPath()) => config_path($this->getConfigName() . '.php')
        ], ['config', $this->getModuleName() . '-module-config']);
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom($this->modulePath($this->getConfigPath()), $this->getConfigName());
    }

    protected function getConfigPath(): string
    {
        return 'config' . DIRECTORY_SEPARATOR . 'config.php';
    }

    protected function getConfigName(): string
    {
        return $this->getModuleName();
    }
}
