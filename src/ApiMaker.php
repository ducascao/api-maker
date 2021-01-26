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

    public function findMarkerAndAddText(string $marker, string $text, string $fileContent): string
    {
        $arrayText = explode(PHP_EOL, $fileContent);

        $arrayText = array_map(function ($line) use ($marker, $text) {
            $posMarker = strpos($line, $marker);

            if ($posMarker !== false) {
                $line .= PHP_EOL . str_repeat(' ', $posMarker) . $text;
            }

            return $line;
        }, $arrayText);

        return implode(PHP_EOL, $arrayText);
    }
}
