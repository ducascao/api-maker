<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\ProviderServiceInterface;
use Illuminate\Support\Facades\Facade;

class Provider extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProviderServiceInterface::class;
    }
}
