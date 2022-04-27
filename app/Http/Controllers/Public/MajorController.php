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
        return $this->view('public.majors.show', [
            "title" => "$major->name",
            "major" => $major,
        ]);
    }
}
