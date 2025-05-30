<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function __construct(
        protected Contact $contact
    ) {}

    public function store(ContactRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->contact->create($request->validated());

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Data gagal disimpan');
        }
    }

    public function updateStatus($id)
    {
        DB::beginTransaction();

        try {
            $contact = $this->contact->find($id);
            if (!$contact) {
                throw new \Exception('Data tidak ditemukan');
            }

            $contact->status = !$contact->status;
            $contact->save();

            DB::commit();
            return back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Data gagal disimpan');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $contact = $this->contact->find($id);
            if (!$contact) {
                throw new \Exception('Data tidak ditemukan');
            }

            $contact->delete();

            DB::commit();
            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Data gagal dihapus');
        }
    }
}
