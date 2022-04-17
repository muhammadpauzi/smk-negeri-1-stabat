<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                ->orWhere('url', 'LIKE', "%$searchKeyword%");
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
    public function edit(Slide $slide)
    {
        return view('slides.edit', [
            "title" => "Edit Slide",
            "slide" => $slide
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $rules = [
            'title' => 'required|max:256',
            'subtitle'   => 'max:512',
            'image' => 'image|file|max:1024',
        ];

        if ($request->url) $rules['url'] = 'url';

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->post('old-slide-image') && !strpos($slide->image, "default")) Storage::delete($request->post('old-slide-image'));
            $validatedData['image'] = $request->file('image')->store('slide-images');
        }

        $slide->update($validatedData);

        return redirect()->route('slides.index')->with('success', 'Slide has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        if ($slide->image && !strpos($slide->image, "default")) Storage::delete($slide->image);
        $slide->delete();
        return redirect()->route('slides.index')->with('success', 'Slide has been deleted.');
    }
}
