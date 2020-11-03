<?php

namespace App\Build;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MigrationService
{
    public function create(String $name, array $fields)
    {
        Artisan::call('make:model ' .$name. ' -m');

        $migrations = Storage::disk('migrations')->allFiles();

        $migration = array_filter($migrations, function ($value) use ($name) {
            return strpos(strtolower($value), strtolower($name)) !== false;
        });

        $migrationFileName = implode('', $migration);
        $migrationFile = Storage::disk('migrations')->get($migrationFileName);

        $dummyFields = $this->dummyFields($fields);
        $migrationFile = str_replace('$dummyFields;', $dummyFields, $migrationFile);
        Storage::disk('migrations')->put($migrationFileName, $migrationFile);
    }

    public function dummyFields(array $fields)
    {
        $dummyFields = '';

        foreach ($fields as $key => $value) {
            $dummyFields .= $this->addField($value, $key, count($fields));
        }

        return $dummyFields;
    }

    public function addField($field, Int $pos, Int $size)
    {
        $tab = '            ';
        $table = '$table->';
        $nullable = '';
        $dummyField = '';

        if (isset($field['required']) && $field['required'] === false) {
            $nullable = "->nullable()";
        }

        if (isset($field['relationship'])) {
            $dummyField .= $this->addRelationField($field, $nullable);
        } else {
            if ($pos === $size - 1) {
                $dummyField .= $tab.$table.$field['type']."('$field[name]')$nullable";
            } elseif ($pos === 0) {
                $dummyField .= $table.$field['type']."('$field[name]')$nullable\n";
            } else {
                $dummyField .= $tab.$table.$field['type']."('$field[name]')$nullable\n";
            }
        }

        return $dummyField;
    }

    public function addRelationField($field, String $nullable = '')
    {
        $tab = '            ';
        $table = '$table->';
        $dummyField = '';
        $relation = $field['relationship']['table'];
        $relationField = 'id';
        
        if (isset($field['relationship']['field'])) {
            $relationField = $field['relationship']['field'];
        }

        $dummyField .= $tab.$table."unsignedBigInteger('$field[name]')$nullable\n";
        $dummyField .= $tab.$table."foreign('$field[name]')->references('$relationField')->on('$relation')\n";

        return $dummyField;
    }
}
