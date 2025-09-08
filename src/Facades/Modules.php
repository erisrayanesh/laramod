<?php

namespace ErisRayanesh\Laramod\Facades;

use App\Core\ModulesManager;
use Illuminate\Support\Facades\Facade;


/**
 * Class Modules
 * @method static boot()
 * @method static register()
 */
class Modules extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'modules';
    }
}
