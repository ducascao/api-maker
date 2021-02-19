<?php

namespace Ducascao\ApiMaker\Build;

use Ducascao\ApiMaker\Interfaces\CommonServiceInterface;

class CommonService implements CommonServiceInterface
{
    public function checkLaravelVersion(int $majorVersion = 8) : bool
    {
        $laravelMajorVersion = (int) explode('.', app()->version())[0];

        return ($laravelMajorVersion >= $majorVersion);
    }
}
