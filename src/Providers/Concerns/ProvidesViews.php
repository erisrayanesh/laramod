<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


trait ProvidesViews
{

    protected function publishViews()
    {
        $sourcePath = $this->modulePath($this->getViewsPath());
        $viewPath = resource_path('views' . DIRECTORY_SEPARATOR .
            'modules' . DIRECTORY_SEPARATOR . $this->getModuleName()
        );
        $this->publishes([$sourcePath => $viewPath], ['views', $this->getModuleName() . '-module-views']);
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(array_merge(iterator_to_array($this->viewPaths()), [
            $this->modulePath($this->getViewsPath())
        ]), $this->getModuleName());
    }

    protected function viewPaths(): \Iterator
    {
        foreach (config('view.paths') as $path) {
            $fullPath = $path . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->getModuleName();

            if (is_dir($fullPath)) {
                yield $fullPath;
            }
        }
    }

    protected function getViewsPath(): string
    {
        return 'resources' . DIRECTORY_SEPARATOR . 'views';
    }
}
