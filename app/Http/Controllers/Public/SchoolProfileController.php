<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    public function index()
    {
        return $this->view('public.school-profiles.index', [
            "title" => "School Profile",
        ]);
    }
}
