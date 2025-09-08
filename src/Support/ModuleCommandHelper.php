<?php

namespace ErisRayanesh\Laramod\Support;

use ErisRayanesh\Laramod\Module\ModuleNotFoundException;

trait ModuleCommandHelper
{
    protected function getModule()
    {
        $module = app('modules')->get($this->argument('module'));

        if ($module) {
            return $module;
        }

        throw new ModuleNotFoundException("Modnot not found");
    }
}