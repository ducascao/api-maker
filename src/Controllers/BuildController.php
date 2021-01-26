<?php

namespace Ducascao\ApiMaker\Controllers;

use Illuminate\Http\Request;
use Ducascao\ApiMaker\Facades\Migration;
use Ducascao\ApiMaker\Facades\Model;
use Ducascao\ApiMaker\Facades\Project;

class BuildController extends Controller
{
    public function createProject(Request $request)
    {
        return Project::createProject($request->all());
    }

    public function createMigration(Request $request)
    {
        return Migration::create($request->name, $request->fields);
    }

    public function createModel(Request $request)
    {
        return Model::create($request->name, $request->fields);
    }
}
