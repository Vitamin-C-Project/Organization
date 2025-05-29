<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumniRequest;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AlumniController extends Controller
{
    public function __construct(protected Alumni $alumni) {}

    public function index()
    {
        $alumni = $this->alumni->with(['member', 'membership.position'])->orderBy('id', 'desc')->paginate(10);

        return Inertia::render('alumni/Index', [
            'alumni' => $alumni,
            "configs" => $this->getConfigs()
        ]);
    }

    public function update(AlumniRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $alumni = $this->alumni->find($id);
            if (!$alumni) {
                throw new \Exception('Data tidak ditemukan');
            }

            $alumni->update([
                'destination_name' => $request->validated('destination_name'),
                'appointment' => $request->validated('appointment'),
                'graduation_year' => $request->validated('graduation_year'),
                'type' => $request->validated('type')
            ]);

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Data gagal disimpan');
        }
    }

    public function destroy(Alumni $alumni)
    {
        //
    }
}
