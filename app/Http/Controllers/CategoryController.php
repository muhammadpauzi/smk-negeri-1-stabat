<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @access SUPERADMIN
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $categories = $categories
                ->where('name', 'LIKE',  "%$searchKeyword%")
                ->orWhere('description', 'LIKE', "%$searchKeyword%");
        }

        return view('categories.index', [
            "title" => "Categories",
            "categories" => $categories->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create', [
            "title" => "Create New Category"
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
            'name' => 'required|max:256',
            'description' => 'max:512'
        ]);

        $name = $validatedData['name'];
        $validatedData['slug'] = $this->slug($name, Category::class);

        Category::create($validatedData);

        return redirect()->route("categories.index")->with('success', 'New category has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            "title" => "Edit Category",
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:256',
            'description' => 'max:512'
        ];

        if ($request->slug !== $category->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->slug !== $category->slug) {
            $name = $validatedData['name'];
            $validatedData['slug'] = $this->slug($name, Category::class);
        }

        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category has been deleted.');
    }
}
