<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


trait ProvidesAssets
{

    protected function publishAssets()
    {
        $sourcePath = $this->modulePath($this->getAssetsPath());
        $publicPath = public_path('modules' . DIRECTORY_SEPARATOR . $this->getModuleName());
        $this->publishes([$sourcePath => $publicPath], ['public', $this->getModuleName() . '-module-public']);
    }

    protected function getAssetsPath(): string
    {
        return 'public';
    }
}
