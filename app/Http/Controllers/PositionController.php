<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PositionController extends Controller
{
    public function __construct(
        protected $position = new Position()
    )
    {
    }

    public function index()
    {
        $positions = $this->position->paginate(10);

        return Inertia::render('position/Index', [
            'positions' => $positions
        ]);
    }

    public function store(PositionRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->position->create($request->validated());

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus($id)
    {
        DB::beginTransaction();

        try {
            $position = $this->position->find($id);
            if (!$position) {
                throw new \Exception('Tahun ajaran tidak ditemukan');
            }

            $position->update([
                'status' => $position->status == 1 ? 0 : 1
            ]);

            DB::commit();
            return back()->with('success', "Status '{$position->title}' berhasil diperbaharui");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(PositionRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $position = $this->position->find($id);
            if (!$position) {
                throw new \Exception('Kelas tidak ditemukan');
            }

            $position->update($request->validated());

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $position = $this->position->find($id);
            if (!$position) {
                throw new \Exception('Kelas tidak ditemukan');
            }

            $position->delete();

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
