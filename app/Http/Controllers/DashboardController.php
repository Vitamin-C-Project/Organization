<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Contact;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
        protected Member $member,
        protected Membership $membership,
        protected Alumni $alumni,
        protected Contact $contact
    ) {}

    public function __invoke(Request $request)
    {
        $countMember = $this->member->count();
        $countMemmership = $this->membership->count();
        $countAlumni = $this->alumni->count();
        $contacts = $this->contact->orderBy('status', 'asc')->paginate(2);

        return Inertia::render('dashboard/Index', [
            "configs" => $this->getConfigs(),
            "countMember" => $countMember,
            "countMemmership" => $countMemmership,
            "countAlumni" => $countAlumni,
            "contacts" => $contacts
        ]);
    }
}
