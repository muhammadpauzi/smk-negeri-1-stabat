<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::query()->with(['head']);
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $majors = $majors
                ->where('name', 'LIKE',  "%$searchKeyword%")
                ->orWhere('description', 'LIKE', "%$searchKeyword%");
        }

        return response()->json([
            "success" => true,
            "data" => $majors->latest()->paginate(20)->makeHidden('body')
        ]);
    }

    public function show(Major $major)
    {
        return response()->json([
            "success" => true,
            "data" => $major->load(['head'])
        ]);
    }
}
