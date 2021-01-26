<?php

namespace App\Build;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MidwayService
{
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

    public function baseInterface()
    {
        Artisan::call('make:base-interface BaseInterface');

        $baseInterfaceFile = Storage::disk('services')->get("/Interfaces/BaseInterface.php");

        Storage::disk('local')->put('/project/services/Interfaces/BaseInterface.php', $baseInterfaceFile);
        Storage::disk('services')->delete('/Interfaces/BaseInterface.php');
    }

    public function baseService()
    {
        Artisan::call('make:base-service BaseService');

        $baseServiceFile = Storage::disk('services')->get("BaseService.php");

        Storage::disk('local')->put('/project/services/BaseService.php', $baseServiceFile);
        Storage::disk('services')->delete('BaseService.php');
    }

    public function serviceInterface(string $name)
    {
        Artisan::call('make:service-interface ' .$name.'ServiceInterface');
        $interfaces = Storage::disk('services')->allFiles('/Interfaces');

        $serviceInterface = array_filter($interfaces, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $serviceInterfaceFileName = implode('', $serviceInterface);
        $serviceInterfaceFile = Storage::disk('services')->get($serviceInterfaceFileName);

        Storage::disk('local')->put('/project/services/'.$serviceInterfaceFileName, $serviceInterfaceFile);
        Storage::disk('services')->delete($serviceInterfaceFileName);
    }

    public function baseRepositoryInterface()
    {
        Artisan::call('make:base-repository-interface BaseRepositoryInterface');

        $baseInterfaceFile = Storage::disk('repositories')->get("/Interfaces/BaseRepositoryInterface.php");

        Storage::disk('local')->put('/project/repositories/Interfaces/BaseRepositoryInterface.php', $baseInterfaceFile);
        Storage::disk('repositories')->delete('/Interfaces/BaseRepositoryInterface.php');
    }

    public function baseRepository()
    {
        Artisan::call('make:base-repository BaseRepository');

        $baseRepositoryFile = Storage::disk('repositories')->get("BaseRepository.php");

        Storage::disk('local')->put('/project/repositories/BaseRepository.php', $baseRepositoryFile);
        Storage::disk('repositories')->delete('BaseRepository.php');
    }

    public function repositoryInterface(string $name)
    {
        Artisan::call('make:repository-interface ' .$name.'RepositoryInterface');
        $interfaces = Storage::disk('repositories')->allFiles('/Interfaces');

        $repositoryInterface = array_filter($interfaces, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $repositoryInterfaceFileName = implode('', $repositoryInterface);
        $repositoryInterfaceFile = Storage::disk('repositories')->get($repositoryInterfaceFileName);

        Storage::disk('local')->put('/project/repositories/'.$repositoryInterfaceFileName, $repositoryInterfaceFile);
        Storage::disk('repositories')->delete($repositoryInterfaceFileName);
    }

    public function repository(string $name)
    {
        Artisan::call('make:repository ' .$name.'Repository');

        $repositories = Storage::disk('repositories')->allFiles();

        $repository = array_filter($repositories, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $repositoryFileName = implode('', $repository);
        $repositoryFile = Storage::disk('repositories')->get($repositoryFileName);

        Storage::disk('local')->put('/project/repositories/'.$repositoryFileName, $repositoryFile);
        Storage::disk('repositories')->delete($repositoryFileName);
    }

    public function service(string $name)
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

    public function facade(string $name)
    {
        Artisan::call('make:facade ' .$name);

        $facades = Storage::disk('facades')->allFiles();

        $facade = array_filter($facades, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $facadeFileName = implode('', $facade);
        $facadeFile = Storage::disk('facades')->get($facadeFileName);

        Storage::disk('local')->put('/project/facades/'.$facadeFileName, $facadeFile);
        Storage::disk('facades')->delete($facadeFileName);
    }
}
