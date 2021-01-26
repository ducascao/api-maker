<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Facades\Controller;
use Ducascao\ApiMaker\Facades\Midway;
use Ducascao\ApiMaker\Facades\Migration;
use Ducascao\ApiMaker\Facades\Model;

class ProjectService
{
    protected $controllerService;

    public function __construct(
        ControllerService $controllerService
    ) {
        $this->controllerService = $controllerService;
    }

    public function createProject(array $projectData)
    {
        $this->createTables($projectData['tables']);
    }

    protected function createTables(array $tables)
    {
        foreach ($tables as $value) {
            Migration::create($value['name'], $value['fields']);
            Model::create($value['name'], $value['fields']);
            Midway::create($value['name']);
            Controller::create(($value['name']));

            sleep(1);
        }
    }
}
