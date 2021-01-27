<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Facades\ApiMaker;
use Ducascao\ApiMaker\Interfaces\ProviderServiceInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ProviderService implements ProviderServiceInterface
{
    public function create(string $name)
    {
        Artisan::call('make:provider-service '.$name.'ServiceProvider');
    }

    public function bind(string $provider, string $name, string $folder, string $type)
    {
        $providerText = $this->findProvider($provider);

        $importText = sprintf(
            'use App\%s\Interfaces\%s%sInterface;
use App\%s\%s%s;',
            $folder,
            $name,
            $type,
            $folder,
            $name,
            $type
        );

        $providerText = ApiMaker::findMarkerAndAddText('/** API Maker: imports */', $importText, $providerText);

        $bindText = sprintf(
            '$this->app->bind(%s%sInterface::class, %s%s::class);',
            $name,
            $type,
            $name,
            $type
        );

        $providerText = ApiMaker::findMarkerAndAddText('/** API Maker: Binds */', $bindText, $providerText);

        File::put($this->getProviderFilePath($provider), $providerText);
    }

    protected function getProviderPath()
    {
        return app_path() . DIRECTORY_SEPARATOR . 'Providers';
    }

    protected function getProviderFilePath(string $name): string
    {
        return $this->getProviderPath().DIRECTORY_SEPARATOR.$name.'ServiceProvider.php';
    }

    protected function findProvider(String $provider)
    {
        if (!File::exists($this->getProviderFilePath($provider))) {
            $this->create($provider);

            return $this->findProvider($provider);
        }

        return File::get($this->getProviderFilePath($provider));
    }
}
