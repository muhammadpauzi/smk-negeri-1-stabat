<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    public function index(){
        $schoolProfile = SchoolProfile::all()->first();
        return response()->json([
            "success"   => true,
            "data" => $schoolProfile
        ])
    }
}
