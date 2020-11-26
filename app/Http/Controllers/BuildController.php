<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Build\MigrationService;
use App\Build\ModelService;
use App\Build\ProjectService;

class BuildController extends Controller
{
    protected $migrationService;
    protected $modelService;
    protected $projectService;

    public function __construct(MigrationService $migrationService, ModelService $modelService, ProjectService $projectService)
    {
        $this->migrationService = $migrationService;
        $this->modelService = $modelService;
        $this->projectService = $projectService;
    }

    public function createProject(Request $request)
    {
        return $this->projectService->createProject($request->all());
    }

    public function createMigration(Request $request)
    {
        return $this->migrationService->create($request->name, $request->fields);
    }

    public function createModel(Request $request)
    {
        return $this->modelService->create($request->name, $request->fields);
    }

    public function createService(Request $request)
    {
        //
    }
}
