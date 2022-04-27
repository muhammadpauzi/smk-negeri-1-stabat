<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Major;
use App\Models\Menu;
use App\Models\SchoolProfile;
use App\Models\Slide;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
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

        $slides = Slide::all();

        return $this->view('public.home.index', [
            "title" => "Home",
            "articles" => $articles,
            "slides" => $slides,
            "category" => $category,
            "author" => $author,
        ]);
    }
}
