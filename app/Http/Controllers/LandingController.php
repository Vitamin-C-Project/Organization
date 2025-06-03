<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Gallery;
use App\Models\Article;
use App\Models\Config;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingController extends Controller
{
    public function __construct(
        protected Config $config,
        protected Article $article,
        protected Gallery $gallery,
        protected Member $member,
        protected Membership $membership,
        protected Alumni $alumni
    ) {}

    public function index()
    {
        $configs = $this->config->all();
        $articles = $this->article->orderBy('id', 'desc')->active()->limit(3)->get();
        $galleries = $this->gallery->with('album')
            ->where('file_type', 'like', '%image%')
            ->whereHas('album', function (Builder $query) {
                $query->active();
            })
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        $countMember = $this->member->count();
        $countMemmership = $this->membership->count();
        $countAlumni = $this->alumni->count();

        return Inertia::render('landing/Home', [
            'configs' => $configs,
            'articles' => $articles,
            'galleries' => $galleries,
            'countMember' => $countMember,
            'countMemmership' => $countMemmership,
            'countAlumni' => $countAlumni,
        ]);
    }

    public function indexArticle(Request $request)
    {
        $query = $this->article->query();

        $query->active();

        $query->when($search = $request->search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        $articles = $query->orderBy('id', 'desc')
            ->paginate($request->per_page)
            ->withQueryString();

        return Inertia::render('landing/Articles', [
            'articles' => $articles,
            'filters' => [
                'search' => $search
            ],
            'configs' => $this->getConfigs()
        ]);
    }

    public function showArticle($slug)
    {
        $article = $this->article->whereSlug($slug)->active()->first();

        return Inertia::render('landing/Article', [
            'article' => $article,
            'configs' => $this->getConfigs()
        ]);
    }

    public function indexAlumni()
    {
        return Inertia::render('landing/Alumni', [
            'configs' => $this->getConfigs()
        ]);
    }
}
