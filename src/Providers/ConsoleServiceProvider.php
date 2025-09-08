<?php

namespace ErisRayanesh\Laramod\Providers;

use Illuminate\Support\ServiceProvider;
use ErisRayanesh\Laramod\Commands\PivotMigrationMakeCommand;


class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        PivotMigrationMakeCommand::class
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = $this->commands;
        return $provides;
    }
}
