<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Facades\ApiMaker;
use Ducascao\ApiMaker\Interfaces\RouteServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RouteService implements RouteServiceInterface
{
    public function create(string $name): void
    {
        $routeFile = File::get($this->getRouteFilePath());

        $routeText = sprintf(
            "Route::apiResource('%s', '%sController');",
            $this->getResourceName($name),
            $name
        );

        ApiMaker::findMarkerAndAddText('/** API Maker: Routes */', $routeText, $routeFile);

        File::put($this->getRouteFilePath(), $routeFile);
    }

    protected function getRoutePath(): string
    {
        return base_path() . DIRECTORY_SEPARATOR . 'routes';
    }

    protected function getRouteFilePath(): string
    {
        return $this->getRoutePath() . DIRECTORY_SEPARATOR . 'api.php';
    }

    protected function getResourceName(string $name): string
    {
        return Str::kebab(Str::plural($name));
    }
}
