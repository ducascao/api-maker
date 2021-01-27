<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Facades\Provider;
use Ducascao\ApiMaker\Interfaces\MidwayServiceInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

class MidwayService implements MidwayServiceInterface
{
    protected $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function create(string $name)
    {

        $this->baseRepository();
        $this->baseRepositoryInterface();
        $this->repositoryInterface($name);
        $this->baseInterface();
        $this->baseService();
        $this->serviceInterface($name);
        $this->repository($name);
        $this->service($name);
        $this->facade($name);
    }

    public function baseRepository()
    {
        Artisan::call('make:base-repository BaseRepository');
    }

    public function baseRepositoryInterface()
    {
        Artisan::call('make:base-repository-interface BaseRepositoryInterface');
    }

    public function repositoryInterface(string $name)
    {
        Artisan::call('make:repository-interface ' .$name.'RepositoryInterface');
    }

    public function baseInterface()
    {
        Artisan::call('make:base-interface BaseServiceInterface');
    }

    public function baseService()
    {
        Artisan::call('make:base-service BaseService');
    }

    public function serviceInterface(string $name)
    {
        Artisan::call('make:service-interface ' .$name.'ServiceInterface');
    }

    public function repository(string $name)
    {
        Artisan::call('make:repository ' .$name.'Repository');

        Provider::bind('Repository', $name, 'Repositories', 'Repository');
    }

    protected function getServicePath()
    {
        return app_path() . DIRECTORY_SEPARATOR . 'Services';
    }

    public function service(string $name)
    {
        Artisan::call('make:service ' .$name.'Service');

        Provider::bind('Domain', $name, 'Services', 'Service');
    }

    public function facade(string $name)
    {
        Artisan::call('make:facade ' .$name);
    }
}
