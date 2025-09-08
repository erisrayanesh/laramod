<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


use Illuminate\Support\Facades\File;

trait ProvidesRoutes
{

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        foreach ($this->routes() as $route) {
            $this->loadRoutesFrom($this->modulePath($this->getRoutesPath($route . '.php')));
        }
    }

    protected function routes(): array
    {
        return iterator_to_array($this->findRouteFiles());
    }

    protected function findRouteFiles(): \Iterator
    {
        $files = File::allFiles($this->modulePath($this->getRoutesPath()));

        foreach ($files as $file) {
            yield $file->getBasename('.'.$file->getExtension());;
        }
    }

    protected function getRoutesPath(?string $filename=null): string
    {
        return 'routes'. ($filename? DIRECTORY_SEPARATOR . $filename : '');
    }
}
