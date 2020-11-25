<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Build\MigrationService;
use App\Build\ModelService;

class BuildController extends Controller
{
    protected $migrationService;
    protected $modelService;
    protected $projectService;

    public function __construct(MigrationService $migrationService, ModelService $modelService)
    {
        $this->migrationService = $migrationService;
        $this->modelService = $modelService;
    }

    public function createProject(Request $request)
    {
        //
    }

    public function createMigration(Request $request)
    {
        return $this->migrationService->create($request->name, $request->fields);
    }

    public function createModel(Request $request)
    {
        return $this->modelService->create($request->name, $request->fields);
    }
}
