<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;

use Illuminate\Support\Facades\File;

trait ProvidesSeeders
{
    protected array $seeders;

    protected function publishSeeders()
    {
        if ($this->app->environment('production') || !$this->app->runningInConsole()) {
            return;
        }

        if ($publishable = $this->seeders()) {
            $this->publishes($publishable, ['seeders', $this->getModuleName() . '-module-seeders']);
        }
    }

    protected function getSeedersPath(?string $filename=null): string
    {
        return 'database' . DIRECTORY_SEPARATOR . 'seeders'. ($filename? DIRECTORY_SEPARATOR . $filename : '');
    }

    protected function seeders(): array
    {
        return iterator_to_array($this->findSeeders());
    }

    protected function findSeeders(): \Iterator
    {
        $files = File::allFiles($this->modulePath($this->getSeedersPath()));

        foreach ($files as $file) {
            yield $file->getPathname() => $this->getSederFilePath($file->getFilename());
        }
    }

    protected function getSederFilePath($fileName): string
    {
        return database_path('seeders' . DIRECTORY_SEPARATOR . $fileName);
    }
}
