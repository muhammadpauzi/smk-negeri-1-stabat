<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::query()->latest();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $slides = $slides->where('title', 'LIKE', "%$searchKeyword%")
                ->orWhere('subtitle', 'LIKE', "%$searchKeyword%")
                ->orWhere('link', 'LIKE', "%$searchKeyword%");
        }

        return view('slides.index', [
            "title" => "Slides",
            "slides" => $slides->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slides.create', [
            "title" => "Create New Slide",
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
        $rules = [
            'title' => 'required|max:256',
            'subtitle'   => 'max:512',
            'image' => 'required|image|file|max:1024',
        ];

        if ($request->url) $rules['url'] = 'url';

        $validatedData = $request->validate($rules);

        $validatedData['image'] = $request->file('image')->store('slide-images');

        Slide::create($validatedData);

        return redirect()->route("slides.index")->with('success', 'New slide has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        return view('slides.show', [
            "title" => "$slide->title",
            "slide" => $slide
        ]);
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
