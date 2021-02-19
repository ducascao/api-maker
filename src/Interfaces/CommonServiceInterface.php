<?php

namespace Ducascao\ApiMaker\Interfaces;

interface CommonServiceInterface
{
    public function checkLaravelVersion(int $majorVersion = 8) : bool;
}
