<?php

namespace App\Build;

use App\Build\MigrationService;
use App\Build\ModelService;
use App\Build\MidwayService;
use App\Build\ControllerService;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    protected $migrationService;
    protected $modelService;
    protected $midService;
    protected $controllerService;

    public function __construct(
        MigrationService $migrationService,
        ModelService $modelService,
        MidwayService $midService,
        ControllerService $controllerService
    ) {
        $this->migrationService = $migrationService;
        $this->modelService = $modelService;
        $this->midService = $midService;
        $this->controllerService = $controllerService;
    }

    public function createProject(array $projectData)
    {
        $this->createTables($projectData['tables']);
    }

    public function createTables(array $tables)
    {
        foreach ($tables as $value) {
            $this->migrationService->create($value['name'], $value['fields']);
            $this->modelService->create($value['name'], $value['fields']);
            $this->midService->create($value['name']);
            $this->controllerService->create(($value['name']));
        }
    }

    public function createServices(string $name)
    {
        $this->comService->create($name);
    }

    public function createControllers()
    {
        //
    }

    public function createRoutes()
    {
        //
    }
}
