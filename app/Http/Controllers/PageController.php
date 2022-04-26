<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function show(Page $page)
    {
        return view('pages.show', [
            "title" => "$page->title",
            "page" => $page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        // $this->authorize('update', $page); // sudah di middleware

        return view('pages.edit', [
            "title" => "Edit Page",
            "menus" => Menu::all(),
            "page" => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        // $this->authorize('update', $page); // sudah di middleware

        $rules = [
            'title' => 'required|max:256',
            'menu_id'   => 'required|numeric',
            'image' => 'image|file|max:1024',
            'body'   => 'required'
        ];

        if ($request->slug !== $page->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->post('old-page-image') && !strpos($page->image, "default")) Storage::delete($request->post('old-page-image'));
            $validatedData['image'] = $request->file('image')->store('page-images');
        }

        if ($request->post('old-title') !== $request->post('title')) {
            $title = $validatedData['title'];
            $validatedData['slug'] = $this->slug($title, Page::class);
        }

        $page->update($validatedData);

        return redirect()->route('dashboard.pages.index')->with('success', 'Page has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete', $page);

        if ($page->image && !strpos($page->image, "default")) Storage::delete($page->image);
        $page->delete();
        return redirect()->route('dashboard.pages.index')->with('success', 'Page has been deleted.');
    }
}
