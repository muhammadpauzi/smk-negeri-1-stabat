<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::query();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $menus = $menus
                ->where('name', 'LIKE',  "%$searchKeyword%");
        }

        return view('menus.index', [
            "title" => "Menus",
            "menus" => $menus->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create', [
            "title" => "Create New Menu"
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
            'icon' => 'max:1024'
        ]);

        $name = $validatedData['name'];
        // $validatedData['slug'] = $this->slug($name, Menu::class);

        Menu::create($validatedData);

        return redirect()->route("dashboard.menus.index")->with('success', 'New menu has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', [
            "title" => "Edit Menu",
            "menu" => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:256',
            'icon' => 'max:1024'
        ]);

        $menu->update($validatedData);

        return redirect()->route('dashboard.menus.index')->with('success', 'Menu has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->pages()->get()->isNotEmpty()) {
            return redirect()->route('dashboard.menus.index')->with('errorMessage', 'Can\'t delete this menu, because there pages that still use it.');
        }
        $menu->delete();
        return redirect()->route('dashboard.menus.index')->with('success', 'Menu has been deleted.');
    }
}
