<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MemberController extends Controller
{
    public function __construct(
        protected Member $member,
        protected Grade $grade,
        protected AcademicYear $year,
    )
    {
    }

    public function index()
    {
        $members = $this->member->with('year', 'grade')->withCount('membership as is_membership')->paginate(10);

        return Inertia::render('member/Index', [
            'members' => $members,
        ]);
    }

    public function create()
    {
        $year = $this->year->whereStatus(1)->first();
        if (!$year) {
            $year = $this->year->first();
        }

        $grades = $this->grade->all();

        return Inertia::render('member/Create', [
            'year' => $year,
            'grades' => $grades,
        ]);
    }

    public function store(MemberRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->member->create([
                'year_id' => $request->validated('year'),
                'grade_id' => $request->validated('grade'),
                'name' => $request->validated('name'),
                'phone' => $request->validated('phone'),
                'gender' => $request->validated('gender'),
                'birth_place' => $request->validated('birth_place'),
                'birth_date' => $request->validated('birth_date'),
                'address' => $request->validated('address'),
                'father_name' => $request->validated('father_name'),
                'created_by' => Auth::user()->name,
            ]);

            DB::commit();
            return redirect()->route('member.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id) {
        $member = $this->member->find($id);
        if (!$member) {
            return redirect()->route('member.index')->with('warning', 'Data tidak ditemukan');
        }

        $year = $this->year->whereStatus(1)->first();
        if (!$year) {
            $year = $this->year->first();
        }

        $grades = $this->grade->all();

        return Inertia::render('member/Edit', [
            'member' => $member,
            'year' => $year,
            'grades' => $grades,
        ]);
    }

    public function update(MemberRequest $request, $id) {
        DB::beginTransaction();

        try {
            $member = $this->member->find($id);
            if (!$member) {
                throw new \Exception('Data tidak ditemukan');
            }

            $member->update([
                'grade_id' => $request->validated('grade'),
                'name' => $request->validated('name'),
                'phone' => $request->validated('phone'),
                'gender' => $request->validated('gender'),
                'birth_place' => $request->validated('birth_place'),
                'birth_date' => $request->validated('birth_date'),
                'address' => $request->validated('address'),
                'father_name' => $request->validated('father_name'),
            ]);

            DB::commit();
            return redirect()->route('member.index')->with('success', "Data '{$member->name}' berhasil diperbaharui");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus($id) {
        DB::beginTransaction();

        $member = $this->member->find($id);
        if (!$member) {
            return redirect()->route('member.index')->with('warning', 'Data tidak ditemukan');
        }

        try {
            $member->update([
                'status' => !$member->status,
            ]);

            DB::commit();
            return back()->with('success', "Status '{$member->name}' berhasil diperbaharui");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        DB::beginTransaction();

        try {
            $member = $this->member->find($id);
            if (!$member) {
                throw new \Exception('Data tidak ditemukan');
            }

            $member->delete();

            DB::commit();
            return redirect()->route('member.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
