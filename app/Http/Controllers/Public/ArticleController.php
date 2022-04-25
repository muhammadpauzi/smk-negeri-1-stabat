<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        if (!$article->is_published) {
            // return abort(403, 'This article not published yet.');
            return abort(404);
        }
        $schoolProfile = SchoolProfile::all()->first();

        $article->increment('views', 1);

        return view('public.articles.show', [
            "title" => "$article->title",
            "article" => $article,
            "schoolProfile" => $schoolProfile,
            "majors" => $this->majors()
        ]);
    }
}
