<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Config;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingController extends Controller
{
    public function __construct(
        protected Config $config,
        protected Article $article
    ) {}

    public function index()
    {
        $configs = $this->config->all();
        $articles = $this->article->orderBy('id', 'desc')->active()->limit(3)->get();

        return Inertia::render('landing/Home', [
            'configs' => $configs,
            'articles' => $articles
        ]);
    }
}
