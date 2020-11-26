<?php

namespace App\Build;

use app\Build\MigrationService;
use app\Build\ModelService;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    protected $migrationService;
    protected $modelService;

    public function __construct(MigrationService $migrationService, ModelService $modelService)
    {
        $this->migrationService = $migrationService;
        $this->modelService = $modelService;
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
        }
    }

    public function createServices()
    {
        //
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
