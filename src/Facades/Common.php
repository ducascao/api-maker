<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\CommonServiceInterface;
use Illuminate\Support\Facades\Facade;

class Common extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CommonServiceInterface::class;
    }
}
