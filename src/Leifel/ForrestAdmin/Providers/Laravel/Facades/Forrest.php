<?php

namespace Leifel\ForrestAdmin\Providers\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class ForrestAdmin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'forrestadmin';
    }
}
