<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ConfigController extends Controller
{
    public function __construct(protected Config $config) {}

    public function index()
    {
        $configs = $this->config->paginate();

        return Inertia::render('config/Index', [
            'configs' => $configs
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $config = $this->config->find($id);
            if (!$config) {
                throw new \Exception('Data tidak ditemukan');
            }

            $formData = [
                "value" => $request->value
            ];

            if ($request->hasFile('value')) {
                if ($config->value && Storage::disk('public')->exists($config->value)) {
                    Storage::delete($config->value);
                }

                $formData["value"] = $request->file('value')->store('config', 'public');
            }

            $config->update($formData);

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
