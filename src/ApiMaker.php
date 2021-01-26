<?php

namespace Ducascao\ApiMaker;

class ApiMaker
{
    /**
     * Register ApiMaker routes.
     */
    public function routes(?object $router = null)
    {
        if (!$router) {
            $router = app('router');
        }
        
        $router->group(['prefix' => 'build', 'namespace' => '\Ducascao\ApiMaker\Controllers'], function () use ($router) {
            $router->post('/project', 'BuildController@createProject');
            $router->post('/migration', 'BuildController@createMigration');
            $router->post('/model', 'BuildController@createModel');
        });
    }
}
