<?php

namespace App\apps\Util;

use DateTime;

class Logger
{
    static function getDate(): string
    {
        $date = new DateTime();
        return $date->format("y:m:d h:i:s");
    }
}
