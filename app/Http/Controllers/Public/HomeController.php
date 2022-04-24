<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::query()->where('is_published', '=', 1)->take(10)->with(['author', 'category'])->latest()->get();
        // $articles = Article::query()->take(10)->with(['author', 'category'])->latest()->get();
        $schoolProfile = SchoolProfile::all()->first();

        return view('public.home.index', [
            "title" => "Home",
            "articles" => $articles,
            "schoolProfile" => $schoolProfile
        ]);
    }
}
