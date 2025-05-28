<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __construct(
        private Article $article
    ) {}

    public function index()
    {
        $articles = $this->article->paginate();

        return Inertia::render('article/Index', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return Inertia::render('article/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->article->create([
                'title' => $request->validated('title'),
                'content' => $request->validated('content'),
                'image' => $request->validated('image')->store('articles', 'public')
            ]);

            DB::commit();
            return redirect()->route('article.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Article $article)
    {
        //
    }

    public function edit($id)
    {
        $article = $this->article->find($id);
        if (!$article) {
            return back()->with('warning', 'Artikel tidak ditemukan');
        }

        return Inertia::render('article/Edit', [
            'article' => $article
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $article = $this->article->find($id);
        if (!$article) {
            return back()->with('warning', 'Artikel tidak ditemukan');
        }

        try {
            $formData = [
                'title' => $request->validated('title'),
                'content' => $request->validated('content'),
            ];

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($article->image);

                $formData['image'] = $request->validated('image')->store('articles', 'public');
            }

            $article->update($formData);

            DB::commit();
            return redirect()->route('article.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus($id)
    {
        DB::beginTransaction();

        try {
            $article = $this->article->find($id);
            if (!$article) {
                throw new \Exception('Artikel tidak ditemukan');
            }

            $article->status = !$article->status;
            $article->save();

            DB::commit();
            return redirect()->route('article.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $article = $this->article->find($id);
            if (!$article) {
                throw new \Exception('Artikel tidak ditemukan');
            }

            Storage::disk('public')->delete($article->image);

            $article->delete();

            DB::commit();
            return redirect()->route('article.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
