<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingController extends Controller
{
    public function __construct(
        protected Config $config
    ) {}

    public function index()
    {
        $configs = $this->config->all();

        return Inertia::render('landing/Home', [
            'configs' => $configs
        ]);
    }
}
