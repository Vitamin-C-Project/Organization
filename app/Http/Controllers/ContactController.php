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

    public function index()
    {
        //
    }

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

    public function show(Contact $contact)
    {
        //
    }

    public function update(Request $request, Contact $contact)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        //
    }
}
