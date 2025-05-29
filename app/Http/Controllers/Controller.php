<?php

namespace App\Http\Controllers;

use App\Models\Config;

abstract class Controller
{
    public function getConfigs()
    {
        return Config::all();
    }
}
