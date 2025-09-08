<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


use Illuminate\Support\Facades\File;

trait ProvidesMigrations
{

    protected function publishMigrations() {
        if ($this->app->environment('production') || !$this->app->runningInConsole()) {
            return;
        }

        if ($publishable = $this->getPublishableMigrations()) {
            $this->publishes($publishable, ['migrations', $this->getModuleName() . '-module-migrations']);
        }
    }

    protected function registerMigrations()
    {
        if ($this->app->environment('production') || !$this->app->runningInConsole()) {
            return;
        }

        $migrationsPath = database_path('migrations' . DIRECTORY_SEPARATOR . $this->getModuleName());

        $this->loadMigrationsFrom(
            is_dir($migrationsPath)?
                $migrationsPath :
                $this->modulePath($this->getMigrationsPath())
        );
    }

    protected function getMigrationsPath(?string $filename=null): string
    {
        return 'database' . DIRECTORY_SEPARATOR . 'migrations' . ($filename? DIRECTORY_SEPARATOR . $filename : '');
    }

    protected function getPublishableMigrations(): array
    {
        return iterator_to_array($this->findMigrations());
    }

    protected function findMigrations(): \Iterator
    {
        $files = File::allFiles($this->modulePath($this->getMigrationsPath()));

        foreach ($files as $file) {
            yield $file->getPathname() => $this->generateMigrationFileName($file->getFilename());
        }
    }

    protected function generateMigrationFileName($fileName): string
    {
        return database_path(
            'migrations' .
            DIRECTORY_SEPARATOR .
            $this->getModuleName() .
            DIRECTORY_SEPARATOR .
            $fileName
        );
    }
}
