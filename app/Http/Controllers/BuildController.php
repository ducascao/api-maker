<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Build\MigrationService;

class BuildController extends Controller
{
    protected $migrationService;
    protected $projectService;

    public function __construct(MigrationService $migrationService)
    {
        $this->migrationService = $migrationService;
    }

    public function createProject(Request $request)
    {
        //
    }

    public function createMigration(Request $request)
    {
        return $this->migrationService->create($request->name, $request->fields);
    }
}
