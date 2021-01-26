<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\ModelServiceInterface;
use Illuminate\Support\Facades\Facade;

class Model extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ModelServiceInterface::class;
    }
}
