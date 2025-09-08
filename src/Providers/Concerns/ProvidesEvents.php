<?php

namespace ErisRayanesh\Laramod\Providers\Concerns;

use Illuminate\Support\Facades\Event;

trait ProvidesEvents
{

    protected function registerEvents()
    {
        foreach ($this->listeners() as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }

    protected function listeners(): array
    {
        return [];
    }

}