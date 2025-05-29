<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\AcademicYear;
use App\Models\Alumni;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MembershipController extends Controller
{
    public function __construct(
        protected Membership $membership,
        protected AcademicYear $year,
        protected Position $position,
        protected Member $member,
        protected Alumni $alumni
    ) {}

    public function index()
    {
        $memberships = $this->member->with(['membership.year', 'membership.position', 'grade'])->whereHas('membership')->active()->orderBy('id', 'desc')->paginate(10);
        $members = $this->member->whereDoesntHave('membership')->active()->get();
        $positions = $this->position->all();
        $years = $this->year->all();

        return Inertia::render('membership/Index', [
            'members' => $members,
            'positions' => $positions,
            'years' => $years,
            'memberships' => $memberships,
            "configs" => $this->getConfigs()
        ]);
    }

    public function store(MembershipRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->membership->create([
                'member_id' => $request->validated('member'),
                'position_id' => $request->validated('position'),
                'year_id' => $request->validated('year'),
                'status' => $request->validated('status'),
            ]);

            DB::commit();
            return redirect()->route('membership.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(MembershipRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $membership = $this->membership->with('member')->find($id);
            if (!$membership) {
                throw new \Exception('Data tidak ditemukan');
            }

            $membership->update([
                'position_id' => $request->validated('position'),
                'year_id' => $request->validated('year'),
                'status' => $request->validated('status'),
            ]);

            DB::commit();
            return redirect()->route('membership.index')->with('success', "Data '{$membership->member->name}' berhasil diperbaharui");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function transfer(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $membership = $this->membership->with(['member', 'year', 'position'])->find($id);
            if (!$membership) {
                throw new \Exception('Data tidak ditemukan');
            }

            $this->alumni->create([
                'membership_id' => $membership->id,
                'member_id' => $membership->member->id,
                'type' => 4,
            ]);

            $membership->member()->update([
                'status' => 0
            ]);

            $membership->update([
                'status' => 0
            ]);

            DB::commit();
            return redirect()->route('alumni.index')->with('success', "Data '{$membership->member->name}' berhasil di pindahkan ke Alumni");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $membership = $this->membership->find($id);
            if (!$membership) {
                throw new \Exception('Data tidak ditemukan');
            }

            $membership->delete();

            DB::commit();
            return redirect()->route('membership.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
