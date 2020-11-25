<?php

namespace App\Build;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ModelService
{
    public function create(String $name, array $fields)
    {
        $model = $this->findModel($name);

        // Add Fillable fields
        $dummyFillable = $this->dummyFillable($fields);
        $modelFile = str_replace('$dummyFillable;', $dummyFillable, $model['file']);

        Storage::disk('models')->put($model['filename'], $modelFile);
    }

    public function findModel(String $name)
    {
        $models = Storage::disk('models')->allFiles();

        $model = array_filter($models, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        if (count($model) === 0) {
            Artisan::call('make:model ' .$name);

            return $this->findModel($name);
        }

        $modelFileName = implode('', $model);
        $modelFile = Storage::disk('models')->get($modelFileName);

        return [
            'filename' => $modelFileName,
            'file' => $modelFile
        ];
    }

    public function dummyFillable(array $fillables)
    {
        $dummyFillables = '';

        foreach ($fillables as $key => $value) {
            $dummyFillables .= $this->addFieldFillable($value, $key, count($fillables));
        }

        return $dummyFillables;
    }

    public function dummyMethods(array $fields)
    {
        $dummyMethods = '';

        foreach ($fields as $key => $value) {
            $dummyMethods .= $this->addMethods($value, $key, count($fields));
        }

        return $dummyMethods;
    }

    public function addFieldFillable($fillable, Int $pos, Int $size)
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
    public function addMethods($field)
    {
        //hasOne one to one
        //hasMany one to many
        //belongsTo one to many reverse
        //belongsToMany many to many
    }
}
