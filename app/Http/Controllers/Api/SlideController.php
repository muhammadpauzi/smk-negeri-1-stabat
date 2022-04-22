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
        $slides = Slide::query()->latest()->get();

        return response()->json([
            "success" => true,
            "data" => $slides
        ]);
    }
}
