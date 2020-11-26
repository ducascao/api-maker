<?php

namespace App\Build;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ControllerService
{
    public function create(string $name)
    {
        Artisan::call('make:controller-service ' .$name.'Controller');

        $controllers = Storage::disk('controllers')->allFiles();

        $controller = array_filter($controllers, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $controllerFileName = implode('', $controller);
        $controllerFile = Storage::disk('controllers')->get($controllerFileName);

        Storage::disk('local')->put('/project/controllers/'.$controllerFileName, $controllerFile);
        Storage::disk('controllers')->delete($controllerFileName);
    }
}
