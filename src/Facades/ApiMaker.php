<?php

namespace Ducascao\ApiMaker\Facades;

use Illuminate\Support\Facades\Facade;

class ApiMaker extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'api-maker';
    }
}
