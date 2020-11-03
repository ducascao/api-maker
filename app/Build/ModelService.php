<?php

namespace App\Build;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ModelService
{
    public function create(String $name, array $fields)
    {
        $models = Storage::disk('models')->allFiles();

        $model = array_filter($models, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $modelFileName = implode('', $model);
        $modelFile = Storage::disk('models')->get($modelFileName);

        // Add Fillable fields
        $dummyFillable = $this->dummyFillable($fields);
        $modelFile = str_replace('$dummyFields;', $dummyFillable, $modelFile);

        Storage::disk('models')->put($modelFileName, $modelFile);
    }

    public function dummyFillable(array $fields)
    {
        $dummyFields = '';

        foreach ($fields as $key => $value) {
            $dummyFields .= $this->addFieldFillable($value, $key, count($fields));
        }

        return $dummyFields;
    }

    public function dummyMethods(array $fields)
    {
        $dummyMethods = '';

        foreach ($fields as $key => $value) {
            $dummyMethods .= $this->addMethods($value, $key, count($fields));
        }

        return $dummyMethods;
    }

    public function addFieldFillable($field, Int $pos, Int $size)
    {
        $tab = '    ';
        $fillable = '';
        $dummyField = '';

        if ($pos === 0) {
            $fillable .= '$'."fillable = [\n";
        }

        $fillable .= $tab.$tab."'$field[name]'\n";

        if ($pos === $size - 1) {
            $fillable .= "]\n";
        }

        return $dummyField;
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
