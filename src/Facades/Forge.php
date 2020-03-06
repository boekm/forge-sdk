<?php

namespace Boekm\Forge\Facades;

use Illuminate\Support\Facades\Facade;

class Forge extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'forge';
    }
}
