<?php


namespace ErisRayanesh\Laramod;


use ErisRayanesh\Laramod\Events\ModuleRegistered;
use ErisRayanesh\Laramod\Contracts\Module;
use Illuminate\Contracts\Container\Container;


class Manager
{
    /**
     * @var Container
     */
    protected $app;

    /**
     * @var Module[]
     */
    protected $modules = [];

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->modules = [];
    }

    public function register($contract)
    {
        if (isset($this->modules[$contract::name()])) {
            return;
        }

        $this->modules[$contract::name()] = $contract;
        event(new ModuleRegistered($contract));
    }

    /**
     * @return Module[]
     */
    public function all(): array
    {
        return $this->modules;
    }

    public function has($name): bool
    {
        return isset($this->modules[$name]);
    }

    /**
     * @param $name
     * @return Module
     * @throw ModuleNotFoundException
     */
    public function get($name)
    {
        $name = strtolower($name);

        if (!$this->has($name)) {
            throw new ModuleNotFoundException("Module \"$name\" is not registered");
        }

        return $this->modules[$name];
    }

}
