<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::query()->latest();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $slides = $slides->where('title', 'LIKE', "%$searchKeyword%")
                ->orWhere('subtitle', 'LIKE', "%$searchKeyword%")
                ->orWhere('url', 'LIKE', "%$searchKeyword%");
        }

        return response()->json([
            "success" => true,
            "data" => $slides->latest()->paginate(20)
        ]);
    }

    public function show(Slide $slide)
    {
        return response()->json([
            "success" => true,
            "data" => $slide
        ]);
    }
}
