<?php

namespace App\Http\Controllers;

use App\Http\Requests\YearRequest;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AcademicYearController extends Controller
{
    protected $academicYear;

    public function __construct()
    {
        $this->academicYear = new AcademicYear();
    }

    public function index()
    {
        $years = AcademicYear::paginate(10);

        return Inertia::render('academic_year/Index', [
            'years' => $years,
            "configs" => $this->getConfigs()
        ]);
    }

    public function store(YearRequest $request)
    {
        DB::beginTransaction();

        try {
            $yearsCount = $this->academicYear->count();

            $year = $this->academicYear->create($request->validated());
            if ($yearsCount < 1) {
                $year->status = 1;
                $year->save();
            }

            if ($request->status == 1) {
                $this->academicYear->whereNotIn('id', [$year->id])->update(['status' => 0]);
            }

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(YearRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $academicYear = $this->academicYear->find($id);
            if (!$academicYear) {
                throw new \Exception('Tahun ajaran tidak ditemukan');
            }

            $yearsCount = $this->academicYear->count();
            if ($yearsCount < 2) {
                throw new \Exception('Tahun ajaran tidak boleh dinonaktifkan');
            }

            $academicYear->update($request->validated());

            if ($request->status == 1) {
                $this->academicYear->whereNotIn('id', [$academicYear->id])->update(['status' => 0]);
            }

            DB::commit();
            return back()->with('success', "Data '{$academicYear->title}' berhasil diperbaharui");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus($id)
    {
        DB::beginTransaction();

        try {
            $academicYear = $this->academicYear->find($id);
            if (!$academicYear) {
                throw new \Exception('Tahun ajaran tidak ditemukan');
            }

            $yearsCount = $this->academicYear->count();
            if ($yearsCount < 2) {
                throw new \Exception('Tahun ajaran tidak boleh dinonaktifkan');
            }

            $academicYear->update([
                'status' => $academicYear->status == 1 ? 0 : 1
            ]);

            $this->academicYear->whereNotIn('id', [$academicYear->id])->update(['status' => 0]);

            DB::commit();
            return back()->with('success', "Status '{$academicYear->title}' berhasil diperbaharui");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $academicYear = $this->academicYear->find($id);
            if (!$academicYear) {
                throw new \Exception('Tahun ajaran tidak ditemukan');
            }

            $yearsCount = $this->academicYear->count();
            if ($yearsCount < 2) {
                throw new \Exception('Tahun ajaran tidak boleh kosong');
            }

            if ($academicYear->status == 1) {
                $this->academicYear->whereStatus(0)->first()->update(['status' => 1]);
            }

            $academicYear->delete();

            DB::commit();
            return back()->with('success', "Data '{$academicYear->title}' berhasil dihapus");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
