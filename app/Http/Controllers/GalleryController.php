<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Requests\GalleryRequest;
use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class GalleryController extends Controller
{
    public function __construct(
        private Album $album,
        private Gallery $gallery
    ) {}

    public function index()
    {
        $albums = $this->album->withCount('galleries as totalFile')->orderBy('status', 'desc')->paginate(12);

        return Inertia::render('gallery/Index', [
            'albums' => $albums
        ]);
    }

    public function store(AlbumRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($request->validated('status') == true) {
                $this->album->where('status', true)->update(['status' => false]);
            }

            $this->album->create([
                'title' => $request->validated('title'),
                'status' => $request->validated('status'),
            ]);

            DB::commit();
            return redirect()->route('gallery.index')->with('success', 'Album berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($slug)
    {
        $album = $this->album->where('slug', $slug)->first()->load('galleries');
        if (!$album) {
            return redirect()->route('gallery.index')->with('error', 'Data tidak ditemukan');
        }

        $galleries = $album->galleries()
            ->select("file_extension", DB::raw("GROUP_CONCAT (file_name || ',' || file_size || ',' || file_type || ',' || file_path || ',' || id , '|') as files"))
            ->groupBy("file_type")
            ->orderBy('file_extension', 'asc')
            ->paginate(12);

        return Inertia::render('gallery/detail/Index', [
            'album' => $album,
            'galleries' => $galleries
        ]);
    }

    public function update(AlbumRequest $request, $id)
    {
        DB::beginTransaction();

        $album = $this->album->find($id);
        if (!$album) {
            return redirect()->route('gallery.index')->with('error', 'Data tidak ditemukan');
        }

        try {

            $album->update([
                'title' => $request->validated('title'),
            ]);

            DB::commit();
            return redirect()->route('gallery.index')->with('success', 'Album berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();

        $album = $this->album->find($id);
        if (!$album) {
            return redirect()->route('gallery.index')->with('error', 'Data tidak ditemukan');
        }

        try {
            if ($this->album->count() < 2) {
                throw new \Exception('Minimal ada 1 album yang aktif');
            }

            if ($album->status == true) {
                $this->album->where('status', false)
                    ->first()
                    ->update([
                        'status' => true
                    ]);
            } else {
                $this->album->where('status', true)
                    ->update([
                        'status' => false
                    ]);
            }

            $this->album->where('id', $id)
                ->update([
                    'status' => !$album->status
                ]);

            DB::commit();
            return redirect()->route('gallery.index')->with('success', 'Status berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $album = $this->album->find($id);
        if (!$album) {
            return redirect()->route('gallery.index')->with('error', 'Data tidak ditemukan');
        }

        try {
            if ($this->album->count() < 2) {
                return redirect()->route('gallery.index')->with('error', 'Minimal ada 1 album');
            }

            if ($album->status == true) {
                $this->album->where('status', false)
                    ->first()
                    ->update([
                        'status' => true
                    ]);
            }

            $album->galleries->each->delete();

            $album->delete();

            return redirect()->route('gallery.index')->with('success', 'Album berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function upload(GalleryRequest $request, $id)
    {
        DB::beginTransaction();

        $album = $this->album->find($id);
        if (!$album) {
            return redirect()->route('gallery.index')->with('error', 'Data tidak ditemukan');
        }

        try {
            foreach ($request->validated('files') as $file) {
                $this->gallery->create([
                    'album_id' => $album->id,
                    "file_name" => $file->getClientOriginalName(),
                    "file_path" => $file->store("files/{$album->id}/{$file->getClientOriginalExtension()}", 'public'),
                    "file_type" => $file->getClientMimeType(),
                    "file_extension" => $file->getClientOriginalExtension(),
                    "file_size" => $file->getSize(),
                ]);
            }

            DB::commit();
            return redirect()->route('gallery.show', $album->slug)->with('success', 'File berhasil diupload');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function deleteFile($id)
    {
        DB::beginTransaction();

        $file = $this->gallery->where('id', $id)->first();
        if (!$file) {
            return redirect()->route('gallery.show', $file->album->slug)->with('error', 'Data tidak ditemukan');
        }

        try {
            $file->delete();

            DB::commit();
            return redirect()->route('gallery.show', $file->album->slug)->with('success', 'File berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function downloadFile($id)
    {
        $file = $this->gallery->where('id', $id)->first();
        if (!$file) {
            return redirect()->route('gallery.show', $file->album->slug)->with('error', 'Data tidak ditemukan');
        }

        dd($file);

        // return Storage::disk('public')->file($file->file_path);
        return Storage::download($file->file_path);
    }
}
