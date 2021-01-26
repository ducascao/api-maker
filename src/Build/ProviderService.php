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

    public function bind(string $provider, string $name)
    {
        $providerText = $this->findProvider($provider);

        $bindText = sprintf(
            '$this->app->bind(App\Interfaces\%sServiceInterface::class, App\Services\%sService::class);',
            $name,
            $name
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
