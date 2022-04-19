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

        $paginator = $majors->latest()->paginate(20);
        $data = $paginator->makeHidden(['body']);
        $paginator->data = $data;

        return response()->json([
            "success" => true,
            "data" => $paginator
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
