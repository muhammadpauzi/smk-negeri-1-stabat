<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function show(Major $major)
    {
        $schoolProfile = SchoolProfile::all()->first();
        return view('public.majors.show', [
            "title" => "$major->name",
            "major" => $major,
            "majors" => $this->majors(),
            "schoolProfile" => $schoolProfile
        ]);
    }
}
