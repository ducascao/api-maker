<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\ProjectServiceInterface;
use Illuminate\Support\Facades\Facade;

class Project extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProjectServiceInterface::class;
    }
}
