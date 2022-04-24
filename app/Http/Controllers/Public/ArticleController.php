<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        if (!$article->is_published) {
            // return abort(403, 'This article not published yet.');
            return abort(404);
        }
        $schoolProfile = SchoolProfile::all()->first();

        return view('public.articles.show', [
            "title" => "$article->title",
            "article" => $article,
            "schoolProfile" => $schoolProfile
        ]);
    }
}
