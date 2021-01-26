<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\MidwayServiceInterface;
use Illuminate\Support\Facades\Facade;

class Midway extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MidwayServiceInterface::class;
    }
}
