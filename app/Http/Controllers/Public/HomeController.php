<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Major;
use App\Models\SchoolProfile;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $articles = Article::query()->where('is_published', '=', 1)->take(10)->with(['author', 'category'])->latest()->get();
        // $articles = Article::query()->take(10)->with(['author', 'category'])->latest()->get();
        // $articles = Article::query()->with(['category', 'author']);
        // $searchKeyword = request('search');

        // if ($searchKeyword) {
        //     $articles = $articles->where('title', 'LIKE', "%$searchKeyword%")
        //         ->orWhere('description', 'LIKE', "%$searchKeyword%")
        //         ->orWhere('body', 'LIKE', "%$searchKeyword%");
        // }

        $category = null;
        $author = null;
        if (request('category'))
            $category = Category::firstWhere('slug', request('category'));
        if (request('author'))
            $author = User::firstWhere('username', request('author'));

        $articles = Article::with(["author", "category"])
            ->latest()
            ->filter(request(["search", 'category', 'author']))
            ->paginate(10)->withQueryString();

        $schoolProfile = SchoolProfile::all()->first();
        $slides = Slide::all();

        return view('public.home.index', [
            "title" => "Home",
            "articles" => $articles,
            "schoolProfile" => $schoolProfile,
            "slides" => $slides,
            "category" => $category,
            "author" => $author,
            "majors" => $this->majors()
        ]);
    }
}
