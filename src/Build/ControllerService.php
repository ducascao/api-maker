<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Interfaces\ControllerServiceInterface;
use Illuminate\Support\Facades\Artisan;

class ControllerService implements ControllerServiceInterface
{
    public function create(string $name)
    {
        Artisan::call('make:controller-service ' .$name.'Controller');
    }
}
