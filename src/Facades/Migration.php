<?php

namespace Ducascao\ApiMaker\Facades;

use Ducascao\ApiMaker\Interfaces\MigrationServiceInterface;
use Illuminate\Support\Facades\Facade;

class Migration extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MigrationServiceInterface::class;
    }
}
