<?php

namespace Ducascao\ApiMaker\Interfaces;

interface ProviderServiceInterface
{
    public function create(string $name);
    public function bind(string $provider, string $name, string $folder, string $type);
}
