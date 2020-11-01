<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Build\TableService;

class BuildController extends Controller
{
    protected $tableService;
    protected $projectService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function createProject(Request $request)
    {
        //
    }

    public function createTable(Request $request)
    {
        return $this->tableService->create($request->name, $request->fields);
    }
}
