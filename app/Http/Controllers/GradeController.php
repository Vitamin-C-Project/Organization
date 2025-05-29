<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GradeController extends Controller
{
    public function __construct(
        protected $grade = new Grade()
    ) {}

    public function index()
    {
        $grades = $this->grade->paginate(10);

        return Inertia::render('grade/Index', [
            'grades' => $grades,
            "configs" => $this->getConfigs()
        ]);
    }

    public function store(GradeRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->grade->create($request->validated());

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(GradeRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $grade = $this->grade->find($id);
            if (!$grade) {
                throw new \Exception('Kelas tidak ditemukan');
            }

            $grade->update($request->validated());

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
            $grade = $this->grade->find($id);
            if (!$grade) {
                throw new \Exception('Kelas tidak ditemukan');
            }

            $grade->delete();

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
