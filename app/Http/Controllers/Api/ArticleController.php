<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->with(['category', 'author']);
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $articles = $articles->where('title', 'LIKE', "%$searchKeyword%")
                ->orWhere('description', 'LIKE', "%$searchKeyword%")
                ->orWhere('body', 'LIKE', "%$searchKeyword%");
        }

        $paginator = $articles->latest()->paginate(20);
        $data = $paginator->makeHidden(['body']);
        $paginator->data = $data;

        return response()->json([
            "success" => true,
            "data" => $paginator
        ]);
    }

    public function show(Article $article)
    {
        return response()->json([
            "success" => true,
            "data" => $article->load(['category', 'author'])
        ]);
    }
}
