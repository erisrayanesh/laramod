<?php

namespace ErisRayanesh\Laramod\Events;

use ErisRayanesh\Laramod\Contracts\Module as ModuleInterface;

class ModuleRegistered
{
    /**
     * @var ModuleInterface
     */
    public $module;

    public function __construct(ModuleInterface|string $module)
    {
        $this->module = $module;
    }
}