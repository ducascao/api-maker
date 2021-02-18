<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Interfaces\MigrationServiceInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class MigrationService implements MigrationServiceInterface
{
    protected $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function create(String $name, array $fields)
    {
        $table = Str::plural(Str::snake(class_basename($name)));

        Artisan::call('make:migration create_'.$table.'_table');

        $migrations = $this->files->glob($this->getMigrationsPath().DIRECTORY_SEPARATOR.'*create_'.$table.'_table*');

        if (!empty($migrations)) {
            $migrationFile = $this->files->get($migrations[0]);

            $dummyFields = $this->dummyFields($fields);
            $migrationFile = str_replace('$dummyFields;', $dummyFields, $migrationFile);

            $this->files->put($migrations[0], $migrationFile);
        }
    }

    protected function getMigrationsPath()
    {
        return database_path() . DIRECTORY_SEPARATOR . 'migrations';
    }

    protected function dummyFields(array $fields)
    {
        $dummyFields = '';

        foreach ($fields as $key => $value) {
            $dummyFields .= $this->addField($value, $key, count($fields));
        }

        return $dummyFields;
    }

    protected function addField($field, Int $pos, Int $size)
    {
        $tab = '            ';
        $table = '$table->';
        $nullable = '';
        $dummyField = '';
        $size = '';

        if (isset($field['required']) && $field['required'] === false) {
            $nullable = "->nullable()";
        }

        if (isset($field['size'])) {
            $preSize = explode(',', str_replace(' ', '', $field['size']));
            $size = ', ' . implode(', ', $preSize);
        }

        if (isset($field['relationship'])) {
            $dummyField .= $this->addRelationField($field, $nullable);
        } else {
            if ($pos === - 1) {
                $dummyField .= $tab.$table.$field['type']."('$field[name]'$size)$nullable;";
            } elseif ($pos === 0) {
                $dummyField .= $table.$field['type']."('$field[name]'$size)$nullable;\n";
            } else {
                $dummyField .= $tab.$table.$field['type']."('$field[name]'$size)$nullable;\n";
            }
        }

        return $dummyField;
    }

    protected function addRelationField($field, String $nullable = '')
    {
        $tab = '            ';
        $table = '$table->';
        $dummyField = '';
        $relation = $field['relationship']['table'];
        $relationField = 'id';
        
        if (isset($field['relationship']['field'])) {
            $relationField = $field['relationship']['field'];
        }

        $dummyField .= $tab.$table."unsignedBigInteger('$field[name]')$nullable;\n";
        $dummyField .= $tab.$table."foreign('$field[name]')->references('$relationField')->on('$relation');\n";

        return $dummyField;
    }
}
