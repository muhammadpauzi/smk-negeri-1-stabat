<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::query()->latest()->paginate(20)->withQueryString();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $pages = $pages->where('title', 'LIKE', "%$searchKeyword%")
                ->orWhere('body', 'LIKE', "%$searchKeyword%");
        }

        return view('pages.index', [
            "title" => "Pages",
            "pages" => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create', [
            "title" => "Create New Page",
            "menus" => Menu::all()
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
            'menu_id'   => 'required|numeric',
            'image' => 'image|file|max:1024',
            'body'   => 'required'
        ]);

        if ($request->hasFile('image'))
            $validatedData['image'] = $request->file('image')->store('page-images');

        $title = $validatedData['title'];
        $validatedData['slug'] = $this->slug($title, Page::class);

        Page::create($validatedData);

        return redirect()->route("dashboard.pages.index")->with('success', 'New page has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
