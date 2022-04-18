<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // $articles = DB::table('articles')->count();
        $articles = Article::all();
        $categories = Category::all();
        $users = User::all();

        $articlesGroupByIsPublished = $articles->groupBy('is_published');

        $articlePercentages = [
            "published" => round(($articlesGroupByIsPublished->get('1')->count() / $articles->count()) * 100), // 1 === true
            "unpublished" => round(($articlesGroupByIsPublished->get('0')->count() / $articles->count()) * 100) // 0 === false
        ];

        return view('dashboard.index', [
            "title" => "Dashboard",
            "articles"  => $articles,
            "categories"  => $categories,
            "users"  => $users,
            "articlePercentages" => $articlePercentages
        ]);
    }
}
