<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articles = Article::query()->with(['category', 'author'])->latest()->get();
        $articles = auth()->user()->articles()->with(['category', 'author']);
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $articles = $articles->where('title', 'LIKE', "%$searchKeyword%");
        }

        return view('articles.index', [
            "title" => "Articles",
            "articles" => $articles->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create', [
            "title" => "Create New Article",
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:256',
            'category_id'   => 'required|numeric',
            'description'   => 'required',
            'image' => 'required|image|file|max:1024',
            'body'   => 'required'
        ]);

        $validatedData['image'] = $request->file('image')->store('article-images');
        $validatedData['user_id'] = auth()->user()->id;
        $title = $validatedData['title'];
        $validatedData['slug'] = $this->slug($title, Article::class);
        $validatedData['is_published'] = $request->boolean('is-published');

        Article::create($validatedData);

        return redirect()->route("articles.index")->with('success', 'New article has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $loggedInUser = auth()->user();
        if (!$loggedInUser->isSuperadminOrAdmin()) {
            if (!$article->ownedBy($loggedInUser) || !$$article->is_published) {
                // return abort(403, 'This article not published yet.');
                return abort(404);
            }
        }

        return view('articles.show', [
            "title" => "$article->title",
            "article" => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', [
            "title" => "Edit Article",
            "categories" => Category::all(),
            "article" => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $rules = [
            'title' => 'required|max:256',
            'category_id'   => 'required|numeric',
            'description'   => 'required',
            'image' => 'image|file|max:1024',
            'body'   => 'required'
        ];

        if ($request->slug !== $article->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->post('old-article-image')) Storage::delete($request->post('old-article-image'));
            $validatedData['image'] = $request->file('image')->store('article-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['is_published'] = $request->boolean('is-published');
        if ($request->post('old-title') !== $request->post('title')) {
            $title = $validatedData['title'];
            $validatedData['slug'] = $this->slug($title, Article::class);
        }

        $article->update($validatedData);

        return redirect()->route('articles.index')->with('success', 'Article has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        if ($article->image) Storage::delete($article->image);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article has been deleted.');
    }
}
