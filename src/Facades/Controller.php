<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\ControllerServiceInterface;
use Illuminate\Support\Facades\Facade;

class Controller extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ControllerServiceInterface::class;
    }
}
