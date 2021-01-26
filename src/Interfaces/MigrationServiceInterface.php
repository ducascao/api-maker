<?php

namespace Ducascao\ApiMaker\Interfaces;

interface MigrationServiceInterface
{
    public function create(string $name, array $fields);
}
