<?php

namespace App\Build;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MidwayService
{
    public function create(string $name)
    {
        Artisan::call('make:service ' .$name.'Service');

        $services = Storage::disk('services')->allFiles();

        $service = array_filter($services, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $serviceFileName = implode('', $service);
        $serviceFile = Storage::disk('services')->get($serviceFileName);

        Storage::disk('local')->put('/project/services/'.$serviceFileName, $serviceFile);
        Storage::disk('services')->delete($serviceFileName);
    }
}
