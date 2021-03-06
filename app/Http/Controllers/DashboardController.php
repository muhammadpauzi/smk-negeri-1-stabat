<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Major;
use App\Models\Slide;
use App\Models\Student;
use App\Models\Teacher;
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
        $slides = Slide::all();
        $students = Student::all();
        $teachers = Teacher::all();
        $majors = Major::all();

        // articles
        $articlesGroupByIsPublished = $articles->groupBy('is_published');
        $articlePercentages = [
            "published" => $articlesGroupByIsPublished->get('1') ? round(($articlesGroupByIsPublished->get('1')->count() / $articles->count()) * 100) : 0, // 1 === true
            "unpublished" => $articlesGroupByIsPublished->get('0') ? round(($articlesGroupByIsPublished->get('0')->count() / $articles->count()) * 100) : 0 // 0 === false
        ];

        // total article views
        $totalArticleViews = $articles->sum('views');

        // users
        $usersGroupByRole = $users->groupBy('role');
        $userPercentages = [
            "superadmin" => $usersGroupByRole->get('superadmin') ? round(($usersGroupByRole->get('superadmin')->count() / $users->count()) * 100) : 0,
            "admin" => $usersGroupByRole->get('admin') ? round(($usersGroupByRole->get('admin')->count() / $users->count()) * 100) : 0,
            "editor" => $usersGroupByRole->get('editor') ? round(($usersGroupByRole->get('editor')->count() / $users->count()) * 100) : 0,
        ];

        return view('dashboard.index', [
            "title" => "Dashboard",
            "articles"  => $articles,
            "categories"  => $categories,
            "users"  => $users,
            "slides"  => $slides,
            "students"  => $students,
            "teachers"  => $teachers,
            "majors"  => $majors,
            "articlePercentages" => $articlePercentages,
            "userPercentages" => $userPercentages,
            "totalArticleViews" => $totalArticleViews
        ]);
    }
}
