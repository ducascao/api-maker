<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Interfaces\ModelServiceInterface;
use Ducascao\ApiMaker\Facades\Common;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

class ModelService implements ModelServiceInterface
{
    protected $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function create(String $name, array $fields)
    {
        $model = $this->findModel($name);

        // Add Fillable fields
        $dummyFillable = $this->dummyFillable($fields);
        $modelFile = str_replace('$dummyFillable;', $dummyFillable, $model['file']);

        $this->files->put($model['filename'], $modelFile);
    }

    protected function findModel(String $name)
    {
        $model = $this->getModelsPath().DIRECTORY_SEPARATOR.$name.'.php';

        if (!$this->files->exists($model)) {
            $modelName = Common::checkLaravelVersion(8) ? $name : "Models/{$name}";

            Artisan::call("make:model {$modelName}");
            
            return $this->findModel($name);
        }

        $modelFile = $this->files->get($model);

        return [
            'filename' => $model,
            'file' => $modelFile
        ];
    }

    protected function getModelsPath()
    {
        return app_path() . DIRECTORY_SEPARATOR . 'Models';
    }

    protected function dummyFillable(array $fillables)
    {
        $dummyFillables = '';

        foreach ($fillables as $key => $value) {
            $dummyFillables .= $this->addFieldFillable($value, $key, count($fillables));
        }

        return $dummyFillables;
    }

    protected function dummyMethods(array $fields)
    {
        $dummyMethods = '';

        foreach ($fields as $key => $value) {
            $dummyMethods .= $this->addMethods($value, $key, count($fields));
        }

        return $dummyMethods;
    }

    protected function addFieldFillable($fillable, Int $pos, Int $size)
    {
        $tab = '    ';
        $dummyFillable = '';

        if ($pos === 0) {
            $dummyFillable .= 'protected $'."fillable = [\n";
        }

        $dummyFillable .= $tab.$tab."'$fillable[name]',\n";

        if ($pos === $size - 1) {
            $dummyFillable .= $tab."];";
        }

        return $dummyFillable;
    }

    /**
     * @todo Add eloquent methods
     */
    protected function addMethods($field)
    {
        //hasOne one to one
        //hasMany one to many
        //belongsTo one to many reverse
        //belongsToMany many to many
    }
}
